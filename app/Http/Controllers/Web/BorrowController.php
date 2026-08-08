<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function borrow(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $user = Auth::user();
        
        // Cek maksimal peminjaman aktif
        $activeLoans = Peminjaman::where('user_id', $user->id)
                                ->where('status', 'dipinjam')
                                ->count();
        if ($activeLoans >= 3) {
            return back()->with('error', 'Anda telah mencapai batas maksimal peminjaman (3 buku).');
        }

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku sedang kosong.');
        }

        Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => Carbon::today(),
            'tanggal_jatuh_tempo' => Carbon::today()->addDays(7),
            'status' => 'dipinjam',
        ]);

        $buku->stok -= 1;
        $buku->save();

        return redirect()->route('borrows.history')->with('success', 'Buku berhasil dipinjam! Silakan cek riwayat Anda.');
    }

    public function returnBook(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }

        // Hitung denda jika terlambat
        $denda = 0;
        $today = Carbon::today();
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        if ($today->gt($jatuhTempo)) {
            $hariTerlambat = $today->diffInDays($jatuhTempo);
            $denda = $hariTerlambat * 5000;
        }

        $peminjaman->update([
            'tanggal_kembali' => $today,
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        $buku = Buku::find($peminjaman->buku_id);
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        return back()->with('success', 'Buku berhasil dikembalikan' . ($denda > 0 ? " dengan denda Rp" . number_format($denda, 0, ',', '.') : '') . '.');
    }

    public function history(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'Admin' || $user->role === 'Petugas') {
            $history = Peminjaman::with(['buku', 'user'])->latest()->paginate(15);
        } else {
            $history = Peminjaman::with('buku')->where('user_id', $user->id)->latest()->paginate(15);
        }

        return view('borrows.history', compact('history', 'user'));
    }
}

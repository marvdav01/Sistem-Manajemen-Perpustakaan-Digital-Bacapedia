<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function borrow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buku_id' => 'required|exists:bukus,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = $request->user();
        
        // Cek maksimal peminjaman aktif
        $activeLoans = Peminjaman::where('user_id', $user->id)
                                ->where('status', 'dipinjam')
                                ->count();
        if ($activeLoans >= 3) {
            return response()->json(['message' => 'Melebihi batas pinjam (maksimal 3)'], 422);
        }

        $buku = Buku::find($request->buku_id);

        if ($buku->stok <= 0) {
            return response()->json(['message' => 'Stok buku habis'], 409);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => Carbon::today(),
            'tanggal_jatuh_tempo' => Carbon::today()->addDays(7),
            'status' => 'dipinjam',
        ]);

        $buku->stok -= 1;
        $buku->save();

        return response()->json($peminjaman, 201);
    }

    public function returnBook(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($peminjaman->status === 'dikembalikan') {
            return response()->json(['message' => 'Buku sudah dikembalikan'], 400);
        }

        // Hitung denda jika terlambat
        $denda = 0;
        $today = Carbon::today();
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        if ($today->gt($jatuhTempo)) {
            $hariTerlambat = $today->diffInDays($jatuhTempo);
            $denda = $hariTerlambat * 2000;
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

        return response()->json($peminjaman);
    }

    public function history(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'Anggota') {
            $history = Peminjaman::with('buku')->where('user_id', $user->id)->get();
        } else {
            $history = Peminjaman::with(['buku', 'user'])->get();
        }

        return response()->json($history);
    }
}

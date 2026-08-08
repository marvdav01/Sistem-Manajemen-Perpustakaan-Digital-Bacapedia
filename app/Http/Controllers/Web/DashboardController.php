<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'Admin' || $user->role === 'Petugas') {
            $stats = [
                'total_buku' => Buku::count(),
                'total_peminjaman' => Peminjaman::count(),
                'peminjaman_aktif' => Peminjaman::where('status', 'Dipinjam')->count(),
            ];
            $recent_peminjaman = Peminjaman::with(['user', 'buku'])->latest()->take(5)->get();
            
            return view('dashboard.index', compact('stats', 'recent_peminjaman', 'user'));
        } else {
            $stats = [
                'peminjaman_saya' => Peminjaman::where('user_id', $user->id)->count(),
                'peminjaman_aktif' => Peminjaman::where('user_id', $user->id)->where('status', 'Dipinjam')->count(),
            ];
            $recent_peminjaman = Peminjaman::with(['buku'])->where('user_id', $user->id)->latest()->take(5)->get();
            
            return view('dashboard.index', compact('stats', 'recent_peminjaman', 'user'));
        }
    }
}

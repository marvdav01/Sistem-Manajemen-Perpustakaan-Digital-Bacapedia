@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 text-indigo-50 opacity-50">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 3.5l7.5 15h-15L12 5.5z"/></svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Hello, {{ $user->nama }}! 👋</h1>
            <p class="text-slate-500 max-w-2xl text-lg">Welcome back to your Bacapedia dashboard. Here's what's happening with your account today.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if($user->role === 'Admin' || $user->role === 'Petugas')
            <!-- Admin Stats -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center group hover:shadow-md transition-shadow duration-300">
                <div class="p-4 rounded-2xl bg-indigo-50 text-indigo-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Buku</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['total_buku'] }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center group hover:shadow-md transition-shadow duration-300">
                <div class="p-4 rounded-2xl bg-purple-50 text-purple-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Peminjaman</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['total_peminjaman'] }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center group hover:shadow-md transition-shadow duration-300">
                <div class="p-4 rounded-2xl bg-rose-50 text-rose-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['peminjaman_aktif'] }}</h3>
                </div>
            </div>
        @else
            <!-- User Stats -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center group hover:shadow-md transition-shadow duration-300">
                <div class="p-4 rounded-2xl bg-indigo-50 text-indigo-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Pinjaman Saya</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['peminjaman_saya'] }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center group hover:shadow-md transition-shadow duration-300">
                <div class="p-4 rounded-2xl bg-amber-50 text-amber-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ $stats['peminjaman_aktif'] }}</h3>
                </div>
            </div>
        @endif
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">Aktivitas Peminjaman Terbaru</h3>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
        </div>
        <div class="p-0">
            @if(count($recent_peminjaman) > 0)
                <ul class="divide-y divide-slate-100">
                    @foreach($recent_peminjaman as $pinjam)
                        <li class="px-6 py-4 hover:bg-slate-50 transition-colors duration-150 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                                    {{ substr($pinjam->buku->judul ?? 'B', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-slate-800">{{ $pinjam->buku->judul ?? 'Buku Tidak Diketahui' }}</p>
                                    @if($user->role === 'Admin' || $user->role === 'Petugas')
                                        <p class="text-xs text-slate-500">Oleh: {{ $pinjam->user->nama ?? 'Unknown User' }}</p>
                                    @else
                                        <p class="text-xs text-slate-500">Tgl Pinjam: {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if($pinjam->status === 'Dipinjam')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                        Dipinjam
                                    </span>
                                @elseif($pinjam->status === 'Dikembalikan')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Dikembalikan
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">
                                        {{ $pinjam->status }}
                                    </span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-6 py-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <p class="text-slate-500">Belum ada aktivitas peminjaman.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

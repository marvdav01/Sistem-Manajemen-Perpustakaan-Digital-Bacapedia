@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Riwayat Peminjaman</h1>
            <p class="text-slate-500 mt-1">
                {{ $user->role === 'Admin' || $user->role === 'Petugas' ? 'Kelola semua data peminjaman buku.' : 'Daftar buku yang sedang dan pernah Anda pinjam.' }}
            </p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Buku</th>
                        @if($user->role === 'Admin' || $user->role === 'Petugas')
                            <th class="py-4 px-6 font-semibold text-sm text-slate-600">Peminjam</th>
                        @endif
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Tanggal Pinjam</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Jatuh Tempo</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Status</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Denda</th>
                        @if($user->role === 'Admin' || $user->role === 'Petugas')
                            <th class="py-4 px-6 font-semibold text-sm text-slate-600 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($history as $pinjam)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-lg">
                                        {{ substr($pinjam->buku->judul ?? 'B', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-semibold text-slate-800">{{ $pinjam->buku->judul ?? 'Buku Dihapus' }}</p>
                                        <p class="text-xs text-slate-500">ID: {{ $pinjam->id }}</p>
                                    </div>
                                </div>
                            </td>
                            @if($user->role === 'Admin' || $user->role === 'Petugas')
                                <td class="py-4 px-6">
                                    <p class="text-sm text-slate-800">{{ $pinjam->user->nama ?? 'User Dihapus' }}</p>
                                </td>
                            @endif
                            <td class="py-4 px-6 text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6">
                                @if(strtolower($pinjam->status) === 'dipinjam')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                        Dipinjam
                                    </span>
                                @elseif(strtolower($pinjam->status) === 'dikembalikan')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Dikembalikan
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">
                                        {{ $pinjam->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm">
                                @if($pinjam->denda > 0)
                                    <span class="text-red-600 font-semibold">Rp{{ number_format($pinjam->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            
                            @if($user->role === 'Admin' || $user->role === 'Petugas')
                                <td class="py-4 px-6 text-right text-sm font-medium">
                                    @if(strtolower($pinjam->status) === 'dipinjam')
                                        <form action="{{ route('borrows.return', $pinjam->id) }}" method="POST" class="inline" onsubmit="return confirm('Tandai buku ini sebagai dikembalikan?');">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1.5 rounded-lg transition-colors">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-400 italic">Selesai</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ ($user->role === 'Admin' || $user->role === 'Petugas') ? 7 : 5 }}" class="py-12 text-center text-slate-500">
                                Belum ada riwayat peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($history->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $history->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection

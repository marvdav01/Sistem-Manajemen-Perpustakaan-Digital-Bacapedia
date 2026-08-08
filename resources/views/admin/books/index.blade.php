@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Kelola Buku</h1>
            <p class="text-slate-500 mt-1">Kelola data buku dalam perpustakaan digital.</p>
        </div>
        <div>
            <a href="{{ route('admin.books.create') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Buku
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Info Buku</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Penerbit & Tahun</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Kategori</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600 text-center">Stok</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($buku as $b)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-lg">
                                        {{ substr($b->judul, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-semibold text-slate-800">{{ $b->judul }}</p>
                                        <p class="text-xs text-slate-500">{{ $b->penulis }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-slate-800">{{ $b->penerbit }}</p>
                                <p class="text-xs text-slate-500">{{ $b->tahun_terbit }}</p>
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-600">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-700">
                                    {{ $b->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center text-sm font-semibold {{ $b->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $b->stok }}
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.books.edit', $b->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.books.destroy', $b->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-500">
                                Belum ada data buku.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($buku->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $buku->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection

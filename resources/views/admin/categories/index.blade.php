@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Kategori Buku</h1>
            <p class="text-slate-500 mt-1">Kelola data kategori untuk pengelompokan buku.</p>
        </div>
        <div>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600 w-16">ID</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Nama Kategori</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kategoris as $kategori)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 text-sm text-slate-500">{{ $kategori->id }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-slate-800">{{ $kategori->nama_kategori }}</td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.categories.edit', $kategori->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                            <td colspan="3" class="py-12 text-center text-slate-500">
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($kategoris->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $kategoris->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-2">
        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Koleksi
    </a>

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-slate-100">
        <!-- Banner -->
        <div class="relative h-64 sm:h-80 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center overflow-hidden">
            @if($buku->sampul)
                <img src="{{ Storage::url($buku->sampul) }}" alt="{{ $buku->judul }}" class="absolute inset-0 w-full h-full object-cover opacity-40 blur-sm">
                <img src="{{ Storage::url($buku->sampul) }}" alt="{{ $buku->judul }}" class="z-10 h-56 sm:h-72 object-contain shadow-2xl rounded-lg border border-white/20">
            @else
                <!-- Large Document Icon -->
                <svg class="w-32 h-32 text-white opacity-20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                </svg>
            @endif
            
            <div class="absolute bottom-6 left-6 z-20">
                <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full shadow-sm">
                    {{ $buku->kategori->nama_kategori ?? 'Umum' }}
                </span>
            </div>
        </div>

        <div class="p-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ $buku->judul }}</h1>
                    <p class="text-slate-500 font-medium">
                        {{ $buku->penulis }} &bull; {{ $buku->penerbit }}
                    </p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <span class="inline-flex items-center px-4 py-1.5 {{ $buku->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-sm font-bold rounded-full">
                        @if($buku->stok > 0)
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ $buku->stok }} Stok Tersedia
                        @else
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Stok Habis
                        @endif
                    </span>
                </div>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 mb-8 grid grid-cols-1 sm:grid-cols-3 gap-6 border border-slate-100">
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Penerbit</p>
                    <p class="font-semibold text-slate-700">{{ $buku->penerbit }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tahun Terbit</p>
                    <p class="font-semibold text-slate-700">{{ $buku->tahun_terbit }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori</p>
                    <p class="font-semibold text-slate-700">{{ $buku->kategori->nama_kategori ?? 'Umum' }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                @if(Auth::check() && (Auth::user()->role === 'Admin' || Auth::user()->role === 'Petugas'))
                    <a href="{{ route('admin.books.edit', $buku->id) }}" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                        Edit Buku
                    </a>
                    <form action="{{ route('admin.books.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2.5 bg-[#f43f5e] text-white font-bold rounded-xl hover:bg-rose-600 transition-colors shadow-sm shadow-rose-500/30">
                            Hapus Buku
                        </button>
                    </form>
                @else
                    @if($buku->stok > 0)
                        <form action="{{ route('borrows.borrow') }}" method="POST" class="flex-1 max-w-xs" onsubmit="return confirm('Apakah Anda yakin ingin meminjam buku ini?');">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                                Pinjam Buku Ini
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

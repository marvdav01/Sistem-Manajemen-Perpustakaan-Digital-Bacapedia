@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors mb-4">
        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Katalog
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row">
        <!-- Book Cover Area -->
        <div class="md:w-1/3 bg-gradient-to-br from-indigo-100 to-purple-100 p-8 flex items-center justify-center min-h-[300px]">
            <div class="w-40 h-56 bg-white shadow-xl rounded border-l-8 border-indigo-500 flex flex-col items-center justify-center text-center p-4 transform hover:rotate-3 transition-transform duration-500">
                <span class="text-sm font-bold text-slate-800 line-clamp-4">{{ $buku->judul }}</span>
                <span class="text-xs text-slate-500 mt-2">{{ $buku->penulis }}</span>
            </div>
        </div>
        
        <!-- Book Details Area -->
        <div class="md:w-2/3 p-8 flex flex-col">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <div class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg mb-3">
                        {{ $buku->kategori->nama_kategori ?? 'Umum' }}
                    </div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ $buku->judul }}</h1>
                    <p class="text-lg text-slate-600 font-medium">{{ $buku->penulis }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 my-8">
                <div>
                    <p class="text-sm text-slate-500 mb-1">Penerbit</p>
                    <p class="font-semibold text-slate-800">{{ $buku->penerbit }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Tahun Terbit</p>
                    <p class="font-semibold text-slate-800">{{ $buku->tahun_terbit }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Kode Buku</p>
                    <p class="font-semibold text-slate-800 font-mono bg-slate-100 px-2 py-1 rounded inline-block">{{ $buku->buku_id }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 mb-1">Stok Tersedia</p>
                    <div class="flex items-center">
                        <span class="w-2 h-2 rounded-full mr-2 {{ $buku->stok > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        <p class="font-bold {{ $buku->stok > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $buku->stok }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center space-x-4">
                @if($buku->stok > 0)
                    <form action="{{ route('borrows.borrow') }}" method="POST" class="flex-1 flex" onsubmit="return confirm('Apakah Anda yakin ingin meminjam buku ini?');">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center">
                            Pinjam Buku Ini
                        </button>
                    </form>
                @else
                    <button class="flex-1 bg-slate-200 text-slate-500 font-bold py-3 px-6 rounded-xl cursor-not-allowed text-center" disabled>
                        Stok Habis
                    </button>
                @endif
                <button class="w-12 h-12 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:border-rose-200 hover:bg-rose-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

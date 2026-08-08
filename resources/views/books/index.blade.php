@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Katalog Buku</h1>
            <p class="text-slate-500 mt-1">Jelajahi koleksi buku kami yang terus bertambah.</p>
        </div>
        
        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('books.index') }}" class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="pl-10 pr-4 py-2 w-full sm:w-64 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white shadow-sm outline-none transition-all" placeholder="Cari judul atau penulis...">
            </div>
            
            <select name="kategori" class="px-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white shadow-sm outline-none transition-all">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-xl shadow-sm transition-colors font-medium">
                Filter
            </button>
        </form>
    </div>

    <!-- Book Grid -->
    @if(count($buku) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($buku as $b)
                <div class="bg-white rounded-3xl border border-slate-100/50 shadow-[0_4px_20px_rgb(0,0,0,0.03)] overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1.5 transition-all duration-300 group flex flex-col">
                    <div class="h-48 bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center p-6 relative">
                        <!-- Simulated Book Cover -->
                        <div class="w-24 h-32 bg-white shadow-md rounded border-l-4 border-indigo-500 flex items-center justify-center text-center p-2 transform group-hover:scale-105 transition-transform duration-300">
                            <span class="text-xs font-bold text-slate-800 line-clamp-3">{{ $b->judul }}</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-white/80 backdrop-blur-sm text-indigo-700 text-xs font-bold px-2 py-1 rounded-lg">
                                {{ $b->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-bold text-lg text-slate-800 mb-1 line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $b->judul }}</h3>
                        <p class="text-sm text-slate-500 mb-3">{{ $b->penulis }}</p>
                        
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-sm font-semibold {{ $b->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $b->stok > 0 ? 'Stok: ' . $b->stok : 'Habis' }}
                            </span>
                            <a href="{{ route('books.show', $b->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-600 hover:bg-indigo-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $buku->withQueryString()->links('pagination::tailwind') }}
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm">
            <div class="inline-flex justify-center items-center w-20 h-20 rounded-full bg-slate-100 mb-4">
                <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Tidak ada buku ditemukan</h3>
            <p class="text-slate-500 mb-6">Coba sesuaikan kata kunci pencarian atau filter kategori Anda.</p>
            <a href="{{ route('books.index') }}" class="inline-block bg-indigo-50 text-indigo-600 font-semibold px-6 py-2 rounded-xl hover:bg-indigo-100 transition-colors">
                Reset Filter
            </a>
        </div>
    @endif
</div>
@endsection

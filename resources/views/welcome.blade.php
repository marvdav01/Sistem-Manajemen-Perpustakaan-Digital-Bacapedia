<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bacapedia - Perpustakaan Digital Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
        }
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                              radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                              radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="antialiased text-slate-800 selection:bg-indigo-200 selection:text-indigo-900">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 tracking-tight">
                        Bacapedia.
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Fitur</a>
                    <a href="#katalog" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Katalog</a>
                    <div class="h-6 w-px bg-slate-200"></div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-slate-700 hover:text-indigo-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-slate-900 hover:bg-indigo-600 text-white px-5 py-2.5 rounded-full font-medium transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Daftar Sekarang</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center" x-data="{ mobileMenuOpen: false }">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main>
        <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-50/50">
            <!-- Background Decorations -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-200 to-purple-400 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-tight mb-8 drop-shadow-sm">
                    Jelajahi Dunia Melalui <br class="hidden md:block" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Literasi Digital.</span>
                </h1>
                
                <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-600 mb-10">
                    Bacapedia memberikan Anda akses tak terbatas ke ribuan buku digital, jurnal, dan karya tulis terbaik langsung dari genggaman Anda.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-full shadow-xl hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                        Mulai Membaca Gratis
                    </a>
                    <a href="#fitur" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-lg font-semibold rounded-full shadow-sm transition-all duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-indigo-300 to-purple-300 opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="fitur" class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Kenapa Bacapedia?</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                        Cara Baru Menikmati Buku
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Koleksi Terlengkap</h3>
                        <p class="text-slate-600 leading-relaxed">Ribuan koleksi buku dari berbagai genre dan kategori siap untuk dipinjam kapan saja.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Akses Instan</h3>
                        <p class="text-slate-600 leading-relaxed">Pinjam dan baca buku secara langsung tanpa menunggu. Sistem kami cepat dan responsif.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-2 transition-all duration-300">
                        <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Baca Dimana Saja</h3>
                        <p class="text-slate-600 leading-relaxed">Desain responsif memungkinkan Anda membaca buku favorit dari perangkat apapun, desktop atau mobile.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div id="katalog" class="bg-white py-24">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-slate-900 rounded-[3rem] p-12 sm:p-16 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 opacity-20">
                        <svg class="w-96 h-96 text-indigo-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 3.5l7.5 15h-15L12 5.5z"/></svg>
                    </div>
                    
                    <h2 class="relative text-3xl sm:text-4xl font-bold text-white mb-6">
                        Siap Memulai Petualangan Membaca?
                    </h2>
                    <p class="relative text-slate-300 text-lg max-w-2xl mx-auto mb-10">
                        Bergabunglah dengan ribuan pembaca lainnya dan temukan buku favorit Anda berikutnya di Bacapedia hari ini.
                    </p>
                    <a href="{{ route('register') }}" class="relative inline-block bg-white text-slate-900 font-bold px-8 py-4 rounded-full hover:bg-indigo-50 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Buat Akun Gratis
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-center space-y-4">
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                    Bacapedia.
                </span>
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} Sistem Manajemen Perpustakaan Digital. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>

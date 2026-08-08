@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center space-x-4 mb-2">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Profil</h1>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            @if(session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-xl text-sm font-medium border border-green-100 mb-6 flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium border border-red-100 mb-6 flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200">
            </div>

            <div class="pt-6 border-t border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Ubah Kata Sandi (Opsional)</h3>
                <p class="text-sm text-slate-500 mb-6">Biarkan kosong jika Anda tidak ingin mengubah kata sandi Anda saat ini.</p>
                
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi Baru</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-xl shadow-md transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

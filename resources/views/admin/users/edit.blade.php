@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-indigo-600 transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Pengguna</h1>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100/50 overflow-hidden">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition-all bg-slate-50 focus:bg-white" required>
                @error('nama')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition-all bg-slate-50 focus:bg-white" required>
                @error('email')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-2">Peran (Role)</label>
                <select name="role" id="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition-all bg-slate-50 focus:bg-white" required>
                    <option value="Anggota" {{ old('role', $user->role) == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                    <option value="Petugas" {{ old('role', $user->role) == 'Petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-sm text-amber-800 mb-4 font-medium">Ubah Kata Sandi (Kosongkan jika tidak ingin mengubah)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm text-slate-700 mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-xl border border-white focus:ring-2 focus:ring-amber-500 outline-none transition-all bg-white/60">
                        @error('password')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm text-slate-700 mb-2">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-white focus:ring-2 focus:ring-amber-500 outline-none transition-all bg-white/60">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

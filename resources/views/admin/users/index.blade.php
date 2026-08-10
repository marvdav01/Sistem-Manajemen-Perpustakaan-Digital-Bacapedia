@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <p class="text-slate-500 mt-1">Kelola data pengguna, hak akses, dan kata sandi.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Nama</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Email</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Role</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600">Tanggal Bergabung</th>
                        <th class="py-4 px-6 font-semibold text-sm text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 text-sm font-semibold text-slate-800">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&color=4f46e5&background=e0e7ff" class="w-8 h-8 rounded-full mr-3 border border-slate-200">
                                    {{ $user->nama }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-500">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-sm">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg
                                    {{ $user->role === 'Admin' ? 'bg-indigo-100 text-indigo-700' : ($user->role === 'Petugas' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600') }}
                                ">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm text-slate-500">
                                {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium">
                                    Edit
                                </a>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $users->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection

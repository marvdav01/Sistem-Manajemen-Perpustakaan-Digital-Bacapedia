<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        if ($request->has('kategori') && $request->input('kategori') != '') {
            $query->where('kategori_id', $request->input('kategori'));
        }

        $buku = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('books.index', compact('buku', 'kategoris'));
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('books.show', compact('buku'));
    }

    // --- Admin CRUD Methods ---

    public function adminIndex(Request $request)
    {
        $buku = Buku::with('kategori')->latest()->paginate(10);
        return view('admin.books.index', compact('buku'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.books.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sampulPath = null;
        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('sampuls', 'public');
        }

        Buku::create([
            'buku_id' => \Illuminate\Support\Str::uuid()->toString(),
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'tahun_terbit' => $request->tahun_terbit,
            'sampul' => $sampulPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.books.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'tahun_terbit' => 'required|integer',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->all();

        if ($request->hasFile('sampul')) {
            if ($buku->sampul) {
                Storage::disk('public')->delete($buku->sampul);
            }
            $data['sampul'] = $request->file('sampul')->store('sampuls', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        
        if ($buku->sampul) {
            Storage::disk('public')->delete($buku->sampul);
        }
        
        $buku->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}

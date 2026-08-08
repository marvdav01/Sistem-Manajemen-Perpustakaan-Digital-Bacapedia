<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function index()
    {
        return response()->json(Buku::with('kategori')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'tahun_terbit' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $buku = Buku::create([
            'buku_id' => Str::uuid()->toString(),
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'tahun_terbit' => $request->tahun_terbit,
        ]);
        return response()->json($buku, 201);
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku not found'], 404);
        }
        return response()->json($buku);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|string|max:255',
            'penulis' => 'sometimes|string|max:255',
            'penerbit' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|exists:kategoris,id',
            'stok' => 'sometimes|integer|min:0',
            'tahun_terbit' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $buku->update($request->all());
        return response()->json($buku);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku not found'], 404);
        }

        $buku->delete();
        return response()->json(['message' => 'Buku deleted successfully']);
    }
}

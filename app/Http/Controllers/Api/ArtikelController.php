<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel; // Memanggil model Artikel

class ArtikelController extends Controller
{
    // Mengambil semua artikel (READ)
    public function index()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $artikel
        ], 200);
    }

    // Menyimpan artikel baru (CREATE) - INI YANG DIBUTUHKAN ADDARTICLESCREEN!
    public function store(Request $request)
    {
        // Menyimpan data langsung ke database
        $artikel = Artikel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Artikel berhasil ditambahkan!',
            'data' => $artikel
        ], 201);
    }

// ini tes
    
    // Mengambil 1 artikel spesifik (Untuk layar Edit)
    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json(['status' => 'error', 'message' => 'Artikel tidak ditemukan!'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $artikel], 200);
    }

    // Memperbarui artikel (UPDATE)
    public function update(Request $request, $id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json(['status' => 'error', 'message' => 'Artikel tidak ditemukan!'], 404);
        }

        $artikel->update($request->all());

        return response()->json(['status' => 'success', 'message' => 'Artikel diperbarui!', 'data' => $artikel], 200);
    }

    // Menghapus artikel (DELETE)
    public function destroy($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json(['status' => 'error', 'message' => 'Artikel tidak ditemukan!'], 404);
        }

        $artikel->delete();

        return response()->json(['status' => 'success', 'message' => 'Artikel dihapus!'], 200);
    }
}

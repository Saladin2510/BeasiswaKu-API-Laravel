<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{

    public function index()
    {
        // Mengambil semua data beasiswa dari database
        $beasiswa = Beasiswa::all();

        // Mengembalikan data dalam bentuk format JSON
        return response()->json([
            'status' => 'success',
            'data' => $beasiswa
        ], 200);
    }

    public function store(Request $request)
    {
        // Menyimpan data yang dikirim Android ke tabel MySQL
        $beasiswa = Beasiswa::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Mantap! Beasiswa berhasil ditambahkan!',
            'data' => $beasiswa
        ], 201); // 201 artinya "Created"
    }

    public function destroy($id)
    {
        // Cari data beasiswa berdasarkan ID
        $beasiswa = Beasiswa::find($id);

        // Jika datanya tidak ada
        if (!$beasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data beasiswa tidak ditemukan!'
            ], 404);
        }

        // Jika ada, hapus datanya
        $beasiswa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Beasiswa berhasil dihapus dari sistem!',
            'data' => null
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // 1. Cari data beasiswa yang mau diedit
        $beasiswa = Beasiswa::find($id);

        if (!$beasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data beasiswa tidak ditemukan!'
            ], 404);
        }

        // 2. Update datanya dengan data baru dari Android
        $beasiswa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Beasiswa berhasil diperbarui!',
            'data' => $beasiswa
        ], 200);
    }

    public function show($id)
    {
        // Mencari beasiswa berdasarkan ID
        $beasiswa = Beasiswa::find($id);

        if (!$beasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data beasiswa tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $beasiswa
        ], 200);
    }
}
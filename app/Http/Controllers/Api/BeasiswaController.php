<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{

    // Fungsi untuk mengambil data beasiswa (dengan fitur Search & Filter)
    public function index(Request $request)
    {
        // 1. Siapkan "keranjang pencarian"
        $query = Beasiswa::query();

        // 2. Filter Kategori: Jika Android mengirim kategori dan isinya bukan "Semua"
        if ($request->has('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        // 3. Pencarian Teks: Jika Android mengirim kata kunci pencarian
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            // Gunakan kurung (function) agar SQL membacanya sebagai: 
            // Kategori X AND (title LIKE Y OR description LIKE Y)
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 4. Eksekusi query: Ambil hasilnya dan urutkan dari yang terbaru
        $beasiswas = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $beasiswas
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

        // 7. FUNGSI SEARCH (Tambahan untuk mencari beasiswa berdasarkan nama)
    public function search(Request $request)
    {
        $keyword = $request->query('query');
        
        $beasiswa = \App\Models\Beasiswa::where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%")
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $beasiswa
        ], 200);
    }
}
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

            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 4. Eksekusi query
        $beasiswas = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $beasiswas
        ], 200);
    }

    // CREATE DATA
    public function store(Request $request)
    {
        $beasiswa = Beasiswa::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Mantap! Beasiswa berhasil ditambahkan!',
            'data' => $beasiswa
        ], 201);
    }

    // DELETE DATA
    public function destroy($id)
    {
        $beasiswa = Beasiswa::find($id);

        if (!$beasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data beasiswa tidak ditemukan!'
            ], 404);
        }

        $beasiswa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Beasiswa berhasil dihapus dari sistem!',
            'data' => null
        ], 200);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::find($id);

        if (!$beasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data beasiswa tidak ditemukan!'
            ], 404);
        }

        $beasiswa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Beasiswa berhasil diperbarui!',
            'data' => $beasiswa
        ], 200);
    }

    // DETAIL DATA
    public function show($id)
    {
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

    // SEARCH BEASISWA
    public function search(Request $request)
    {
        $keyword = $request->query('query');
        
        $beasiswa = Beasiswa::where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%")
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $beasiswa
        ], 200);
    }

   // TRENDING BEASISWA (BARU)
public function trending()
{
    // Mengambil 5 beasiswa terbaru
    $beasiswa = Beasiswa::orderBy('id', 'desc')
                    ->take(5)
                    ->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Data beasiswa trending berhasil diambil',
        'data' => $beasiswa
    ], 200);
}
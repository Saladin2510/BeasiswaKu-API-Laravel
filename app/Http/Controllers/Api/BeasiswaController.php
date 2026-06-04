<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{

    // ==========================================
    // GET ALL BEASISWA + SEARCH + FILTER
    // ==========================================
    public function index(Request $request)
    {
        $query = Beasiswa::query();

        // FILTER CATEGORY
        if ($request->has('category') && $request->category !== 'Semua') {

            $query->where('category', $request->category);
        }

        // SEARCH
        if ($request->has('search') && $request->search !== '') {

            $search = $request->search;

            $query->where(function($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");

            });
        }

        // AMBIL DATA
        $beasiswas = $query->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $beasiswas
        ], 200);
    }

    // ==========================================
    // CREATE BEASISWA
    // ==========================================
    public function store(Request $request)
    {
        $beasiswa = Beasiswa::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Mantap! Beasiswa berhasil ditambahkan!',
            'data' => $beasiswa
        ], 201);
    }

    // ==========================================
    // DELETE BEASISWA
    // ==========================================
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

    // ==========================================
    // UPDATE BEASISWA
    // ==========================================
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

    // ==========================================
    // DETAIL BEASISWA
    // ==========================================
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

    // ==========================================
    // SEARCH BEASISWA
    // ==========================================
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

    // ==========================================
    // BEASISWA POPULER BERDASARKAN WISHLIST
    // ==========================================
    public function popular()
    {
        $beasiswa = Beasiswa::withCount('wishlists')
                        ->orderBy('wishlists_count', 'desc')
                        ->take(5)
                        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data beasiswa populer berhasil diambil',
            'data' => $beasiswa
        ], 200);
    }
    // ==========================================
    // COUNTDOWN PENDAFTARAN
    // ==========================================
    public function countdown()
    {
        // Tanggal penutupan pendaftaran
        $deadline = Carbon::parse('2026-06-30 23:59:59');

        $now = Carbon::now();

        // Hitung sisa hari
        $daysRemaining = max(0, $now->diffInDays($deadline, false));

        return response()->json([
            'status' => 'success',
            'registration_close' => $deadline->format('Y-m-d H:i:s'),
            'days_remaining' => $daysRemaining,
            'is_closed' => $now->greaterThan($deadline)
        ]);
    }
}
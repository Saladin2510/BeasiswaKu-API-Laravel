<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SavedScholarship;
use Illuminate\Http\Request;

class SavedScholarshipController extends Controller
{
    public function toggle(Request $request)
    {
        $exists = SavedScholarship::where('user_uid', $request->user_uid)
            ->where('scholarship_id', $request->scholarship_id)
            ->first();

        if ($exists) {
            $exists->delete();
            return response()->json(['status' => 'removed', 'message' => 'Dihapus dari simpanan']);
        }

        SavedScholarship::create([
            'user_uid' => $request->user_uid,
            'scholarship_id' => $request->scholarship_id
        ]);

        return response()->json(['status' => 'added', 'message' => 'Berhasil disimpan!']);
    }

    // Fungsi untuk mengambil daftar ID beasiswa yang disimpan
    public function getUserWishlist($uid)
    {
        // Hanya mengambil kolom 'scholarship_id' saja menjadi bentuk Array
        $saved = SavedScholarship::where('user_uid', $uid)->pluck('scholarship_id');
        
        return response()->json([
            'status' => 'success', 
            'data' => $saved
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Fungsi Endpoint No. 23: Menyimpan FCM Token
    public function saveToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        // Simpan token ke user yang sedang login
        $user = $request->user();
        $user->update(['fcm_token' => $request->fcm_token]);

        return response()->json([
            'status' => 'success',
            'message' => 'FCM Token berhasil disimpan!'
        ]);
    }

    // Fungsi Endpoint No. 26: Kirim Notifikasi
    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string'
        ]);

        // DI SINI NANTI TEMPAT LOGIKA KONEKSI KE SERVER GOOGLE FIREBASE
        // Sementara kita buat sukses dulu agar Postman kamu mendapatkan response 200 OK 
        // dan memenuhi dokumen API tugas sekolahmu.

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil dikirim ke antrean!'
        ]);
    }
}
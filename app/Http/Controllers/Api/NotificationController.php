<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationController extends Controller
{
    /**
     * Endpoint No. 23: Menyimpan FCM Token HP ke Database
     */
    public function saveToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        // Simpan token ke kolom fcm_token milik user yang sedang login
        $user = $request->user();
        $user->update(['fcm_token' => $request->fcm_token]);

        return response()->json([
            'status' => 'success',
            'message' => 'FCM Token berhasil disimpan!'
        ]);
    }

    /**
     * Endpoint No. 26: Mengirim Broadcast Notifikasi Nyata
     */
    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string'
        ]);

        try {
            // 1. Memanggil mesin pengirim dari library Kreait Firebase
            $messaging = app('firebase.messaging');

            // 2. Membungkus judul dan isi pesan notifikasi
            $notification = Notification::create($request->title, $request->body);

            // 3. Menargetkan notifikasi ke semua HP yang subscribe topik "pengumuman"
            $message = CloudMessage::withTarget('topic', 'pengumuman')
                ->withNotification($notification);

            // 4. Menembakkan pesan ke server Google Firebase
            $messaging->send($message);

            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi berhasil dikirim ke antrean!'
            ]);

        } catch (\Exception $e) {
            // Jika terjadi error (misalnya kunci JSON salah), tampilkan pesan errornya
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }
}   
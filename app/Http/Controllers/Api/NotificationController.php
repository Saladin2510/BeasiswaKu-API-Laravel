<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use App\Models\NotificationHistory;

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

            $messaging = app('firebase.messaging');

            $notification = Notification::create(
                $request->title,
                $request->body
            );

            $message = CloudMessage::withTarget(
                'topic',
                'pengumuman'
            )
                ->withNotification($notification)
                ->withData([
                    'type' => 'broadcast'
                ]);

            $messaging->send($message);

            // Simpan ke database
            NotificationHistory::create([
                'title' => $request->title,
                'body' => $request->body
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi berhasil dikirim'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

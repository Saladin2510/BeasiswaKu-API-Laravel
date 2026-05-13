<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // 1. FUNGSI REGISTER (DAFTAR)
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Buat User Baru (Password otomatis dienkripsi oleh Hash)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatarResId' => null // Default kosong
        ]);

        // Buat Token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mendaftar!',
            'data' => $user,
            'token' => $token // INI YANG AKAN DISIMPAN ANDROID NANTI
        ], 201);
    }

    // 2. FUNGSI LOGIN
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek email dan password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau Password salah!'
            ], 401);
        }

        // Ambil data user yang berhasil login
        $user = User::where('email', $request->email)->firstOrFail();

        // Buat Token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'data' => $user,
            'token' => $token // INI YANG AKAN DISIMPAN ANDROID NANTI
        ], 200);
    }

    // 3. FUNGSI LOGOUT
    public function logout(Request $request)
    {
        // Hapus (Revoke) token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout'
        ], 200);
    }

    // FUNGSI LOGIN / REGISTER VIA GOOGLE
    public function google(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string'
        ]);

        // 1. Verifikasi ID Token ke server asli Google
        $response = Http::get('https://oauth2.googleapis.com/tokeninfo?id_token=' . $request->id_token);

        if ($response->failed()) {
            return response()->json(['status' => 'error', 'message' => 'Token Google tidak valid!'], 401);
        }

        $payload = $response->json();

        // 2. Cari user berdasarkan email
        $user = User::where('email', $payload['email'])->first();

        if (!$user) {
            // Jika akun belum ada, buat baru dan masukkan foto Google-nya!
            $user = User::create([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => Hash::make(Str::random(24)),
                'avatar_url' => $payload['picture'] ?? null // Tangkap fotonya!
            ]);
        } else {
            // Jika akun sudah ada, perbarui fotonya (siapa tau dia ganti profil)
            if (isset($payload['picture'])) {
                $user->avatar_url = $payload['picture'];
                $user->save();
            }
        }

        // 3. Terbitkan Token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login Google berhasil!',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    // 4. FUNGSI GET PROFIL USER SAAT INI
    public function me(Request $request)
    {
        // Mengembalikan data user berdasarkan Token yang dikirim Android
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ], 200);
    }

    // 5. FUNGSI UPDATE PROFIL
    public function updateProfile(Request $request)
    {
        $user = $request->user(); // Ambil user yang sedang login dari Token

        $request->validate([
            'name' => 'required|string|max:255',
            'avatarResId' => 'nullable|integer'
        ]);

        $user->update([
            'name' => $request->name,
            'avatarResId' => $request->avatarResId
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui!',
            'data' => $user
        ], 200);
    }

    // 6. FUNGSI CEK EMAIL (Tambahan untuk LKPD)
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = \App\Models\User::where('email', $request->email)->exists();

        return response()->json([
            'status' => 'success',
            'exists' => $exists,
            'message' => $exists ? 'Email sudah terdaftar' : 'Email tersedia'
        ], 200);
    }
}
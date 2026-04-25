<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
}
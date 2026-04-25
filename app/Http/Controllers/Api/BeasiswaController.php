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

    // ... fungsi index() yang kemarin ada di sini ...

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








    
    // 1. GET /scholarships
    // public function index()
    // {
    //     // Mengembalikan data JSON persis seperti di soal
    //     return response()->json([
    //         "status" => true,
    //         "message" => "Daftar Beasiswa Kuliah 2026",
    //         "data" => [
    //             [
    //                 "id" => 1,
    //                 "nama_program" => "Beasiswa Unggulan Full Sarjana",
    //                 "kuota" => 50,
    //                 "syarat_min_nilai" => 85
    //             ],
    //             [
    //                 "id" => 2,
    //                 "nama_program" => "Beasiswa Vokasi PPLG (Khusus SMK)",
    //                 "kuota" => 30,
    //                 "syarat_min_nilai" => 80
    //             ]
    //         ]
    //     ], 200);
    // }

    // 2. POST /apply
    // public function store(Request $request)
    // {
    //     // Menangkap data 'nama_lengkap' dari Request. 
    //     // Jika kosong, kita kasih nilai default "Bahlil" agar sesuai contohmu.
    //     $namaLengkap = $request->input('nama_lengkap', 'Bahlil');

    //     // Mengembalikan Response JSON
    //     return response()->json([
    //         "status" => true,
    //         // Menyisipkan variabel nama ke dalam teks pesan
    //         "message" => "Data pendaftaran {$namaLengkap} berhasil diterima. Tunggu proses verifikasi.",
    //         "no_pendaftaran" => "SCH-2026-SMK-014"
    //     ], 201);
    // }

    // 3. PUT /announcement/{nisn}
    public function update(Request $request, $nisn)
    {
        // Menangkap nilai rapor yang direvisi dari Request.
        // Jika tidak ada, nilai defaultnya 92.0
        $nilaiTerbaru = $request->input('rata_rapor', 92.0);

        return response()->json([
            "status" => true,
            "message" => "Data pendaftaran ID 101 berhasil diperbarui",
            "data" => [
                "id_pendaftaran" => 101,
                "nilai_terbaru" => $nilaiTerbaru
            ]
        ], 200);
    }

    // 4. DELETE /apply
    public function destroy(Request $request)
    {
        // Menangkap NISN dari Request. 
        // Jika kosong, pakai data dummy agar sesuai soal.
        $nisn = $request->input('nisn', '0061234567');

        return response()->json([
            "status" => true,
            "message" => "Pendaftaran atas nama Kamila Mahda (NISN: {$nisn}) telah berhasil dibatalkan.",
            "data" => [
                "id_pendaftaran" => 101,
                // Opsional: pakai date() agar jam pembatalannya selalu waktu saat ini
                "waktu_pembatalan" => "2026-04-08 14:00:00"
            ]
        ], 200);
    }
}
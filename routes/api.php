<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeasiswaController;


// GET
Route::get('/beasiswa', [BeasiswaController::class, 'index']);

// POST
Route::post('/beasiswa', [BeasiswaController::class, 'store']);

// DELETE
Route::delete('/beasiswa/{id}', [BeasiswaController::class, 'destroy']);


// GET: Menampilkan daftar beasiswa
// Route::get('/scholarships', [BeasiswaController::class, 'index']);

// // POST: Mendaftar beasiswa
// Route::post('/apply', [BeasiswaController::class, 'store']);

// // PUT: Memperbarui data pendaftaran berdasarkan NISN
// Route::put('/announcement/{nisn}', [BeasiswaController::class, 'update']);

// // DELETE: Membatalkan pendaftaran
// Route::delete('/apply', [BeasiswaController::class, 'destroy']);
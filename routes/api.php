<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeasiswaController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\AuthController;

// ==========================================
// RUTE AUTHENTICATION (LOGIN & REGISTER)
// ==========================================

// Pintu Publik (Tanpa Token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-email', [AuthController::class, 'checkEmail']);
Route::post('/auth/google', [AuthController::class, 'google']);

// Pintu VIP (Wajib bawa Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Update profile
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
});

// ==========================================
// BEASISWA
// ==========================================

// GET
Route::get('/beasiswa', [BeasiswaController::class, 'index']);

Route::get('/beasiswa/search', [BeasiswaController::class, 'search']);

// TRANDING BEASISWA
Route::get('/beasiswa/popular', [BeasiswaController::class, 'popular']);

Route::get('/beasiswa/{id}', [BeasiswaController::class, 'show']);

// POST
Route::post('/beasiswa', [BeasiswaController::class, 'store']);

// DELETE
Route::delete('/beasiswa/{id}', [BeasiswaController::class, 'destroy']);

// PUT
Route::put('/beasiswa/{id}', [BeasiswaController::class, 'update']);


// ==========================================
// ARTIKEL
// ==========================================
Route::apiResource('artikel', ArtikelController::class);


// ==========================================
// TESTIMONIAL
// ==========================================
Route::apiResource('testimonial', TestimonialController::class);


// ==========================================
// WISHLIST
// ==========================================
Route::get('/wishlist/{uid}', [\App\Http\Controllers\Api\SavedScholarshipController::class, 'getUserWishlist']);

Route::post('/wishlist/toggle', [\App\Http\Controllers\Api\SavedScholarshipController::class, 'toggle']);
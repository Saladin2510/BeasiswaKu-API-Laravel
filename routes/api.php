<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeasiswaController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\TestimonialController;

// Beasiswa List
// GET
Route::get('/beasiswa', [BeasiswaController::class, 'index']);
Route::get('/beasiswa/{id}', [BeasiswaController::class, 'show']);
// POST
Route::post('/beasiswa', [BeasiswaController::class, 'store']);
// DELETE
Route::delete('/beasiswa/{id}', [BeasiswaController::class, 'destroy']);
// PUT
Route::put('/beasiswa/{id}', [BeasiswaController::class, 'update']);

// Artikel
Route::apiResource('artikel', ArtikelController::class);

// Testimonial
Route::apiResource('testimonial', TestimonialController::class);

// Wishlist
Route::get('/wishlist/{uid}', [\App\Http\Controllers\Api\SavedScholarshipController::class, 'getUserWishlist']);
Route::post('/wishlist/toggle', [\App\Http\Controllers\Api\SavedScholarshipController::class, 'toggle']);
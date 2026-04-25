<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        // Menampilkan testimoni terbaru di atas
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $testimonials], 200);
    }

    public function store(Request $request)
    {
        $testimonial = Testimonial::create($request->all());
        return response()->json(['status' => 'success', 'message' => 'Ulasan ditambahkan!', 'data' => $testimonial], 201);
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['status' => 'error', 'message' => 'Ulasan tidak ditemukan!'], 404);
        }
        $testimonial->delete();
        return response()->json(['status' => 'success', 'message' => 'Ulasan dihapus!'], 200);
    }
}
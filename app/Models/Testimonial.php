<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Daftarkan kolom-kolom yang boleh diisi dari Android
    protected $fillable = [
        'uid',
        'userName',
        'text',
        'rating',
        'photoUrl',
        'avatarResId'
    ];
}
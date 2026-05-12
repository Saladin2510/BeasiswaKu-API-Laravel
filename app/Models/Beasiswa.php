<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar Laravel mengizinkan kolom ini diisi dari Android
    protected $fillable = ['title', 'category', 'description', 'date', 'imageUrl', 'linkUrl'];
}
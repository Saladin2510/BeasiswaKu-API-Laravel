<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedScholarship extends Model
{
    use HasFactory;

    // Mengizinkan pengisian data
    protected $fillable = [
        'user_uid',
        'scholarship_id'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'body'
    ];
}
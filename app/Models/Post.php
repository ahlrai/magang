<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    'platform',
    'caption',
    'media_url',
    'status',
    'scheduled_at',
    'posted_at',
    'response',
    'user_id',
];

// Cast response JSON agar mudah dipakai
protected $casts = [
    'scheduled_at' => 'datetime',
    'posted_at' => 'datetime',
    'response' => 'array',
];

}

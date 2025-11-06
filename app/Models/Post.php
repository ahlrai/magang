<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_account_id',
        'platform',
        'caption',
        'media_url',
        'status',
        'scheduled_at',
        'posted_at',
        'response',
        'page_id',
    ];

    protected $casts = [
        'response' => 'array',
        'scheduled_at' => 'datetime',
        'posted_at' => 'datetime',
    ];

    public function socialAccount()
    {
        return $this->belongsTo(SocialAccount::class);
    }
}

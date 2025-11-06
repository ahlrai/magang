<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = ['social_media_id', 'account_name', 'account_url', 'credentials'];

    protected $casts = [
        'credentials' => 'array',
    ];

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

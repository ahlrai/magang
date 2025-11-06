<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_account_id',
        'conversation_id',
        'sender_name',
        'message',
        'direction',
        'sent_at',
    ];

    public function socialAccount()
    {
        return $this->belongsTo(SocialAccount::class);
    }
}

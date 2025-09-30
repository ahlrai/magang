<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = ['name', 'username', 'platform', 'status'];

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'contact_id');
    }
}

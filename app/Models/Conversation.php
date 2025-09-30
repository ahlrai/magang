<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversation';

    protected $fillable = ['contact_id', 'message', 'direction'];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}

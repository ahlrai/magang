<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    // 👇 Tambahkan baris ini untuk memastikan nama tabel benar
    protected $table = 'social_medias';

    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public function accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}

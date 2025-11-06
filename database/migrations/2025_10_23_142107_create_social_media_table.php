<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // contoh: Facebook, Instagram, TikTok, YouTube
            $table->string('icon')->nullable(); // icon file path atau emoji opsional
            $table->text('description')->nullable(); // opsional: deskripsi platform
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_medias');
    }
};

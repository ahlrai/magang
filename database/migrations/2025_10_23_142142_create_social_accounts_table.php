<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_media_id')->constrained('social_medias')->cascadeOnDelete();
            $table->string('account_name'); // nama akun (misal: Rubythalib Academy)
            $table->string('account_url');  // URL profil
            $table->boolean('is_connected')->default(false); // menandai apakah akun aktif/terhubung
            $table->json('credentials')->nullable(); // menyimpan API key, access token, page_id, dsb
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};

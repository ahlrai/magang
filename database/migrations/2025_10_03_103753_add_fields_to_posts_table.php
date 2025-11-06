<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // ini saja yang perlu ditambah karena posted_at & response sudah ada
            if (!Schema::hasColumn('posts', 'page_id')) {
                $table->string('page_id')->nullable()->after('media_url');
            }
        });

        // ubah enum status pakai raw SQL
        DB::statement("ALTER TABLE posts MODIFY COLUMN status ENUM('scheduled', 'posted', 'failed') DEFAULT 'scheduled'");
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'page_id')) {
                $table->dropColumn('page_id');
            }
        });

        // balikin enum ke semula (hanya scheduled & posted)
        DB::statement("ALTER TABLE posts MODIFY COLUMN status ENUM('scheduled', 'posted') DEFAULT 'scheduled'");
    }
};

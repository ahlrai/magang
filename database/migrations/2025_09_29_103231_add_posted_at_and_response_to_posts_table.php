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
        if (! Schema::hasColumn('posts', 'posted_at')) {
            $table->timestamp('posted_at')->nullable()->after('scheduled_at');
        }
        if (! Schema::hasColumn('posts', 'response')) {
            $table->json('response')->nullable()->after('posted_at');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn(['posted_at', 'response']);
    });
    }
};

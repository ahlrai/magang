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
            Schema::create('conversations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('social_account_id')->constrained('social_accounts')->cascadeOnDelete();
                $table->string('conversation_id')->nullable(); // dari API platform
                $table->string('sender_name')->nullable();
                $table->text('message');
                $table->enum('direction', ['incoming', 'outgoing']);
                $table->timestamp('sent_at')->nullable();
                $table->timestamps();
            });
 
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation');
    }
};

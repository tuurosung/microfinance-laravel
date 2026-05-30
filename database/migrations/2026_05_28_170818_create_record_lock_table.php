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
        Schema::create('record_locks', function (Blueprint $table) {
            $table->id();
            $table->morphs('lockable');
            $table->foreignId('locked_by');
            $table->timestamp('locked_at');
            $table->timestamp('expires_at'); // TTL safety net
            $table->string('session_id'); // Identify stale locks
            $table->unique(['lockable_type', 'lockable_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_lock');
    }
};

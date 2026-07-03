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
        Schema::create('kyc_ghana_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('kyc_id')->unique()->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Ghana Card (National ID)
            $table->enum('card_status', [
                'present',
                'not_present',
            ])->default('not_present');
            $table->string('card_number')->nullable(); // GHA-XXXXXXXXX-X

            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();

            // Check Sum Verification
            $table->string('check_sum')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_ghana_cards');
    }
};

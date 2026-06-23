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
        Schema::create('kyc_biometrics', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Biometric Classification
            $table->enum('biometric_type', [
                'fingerprint',
                'facial_scan',
                'iris_scan',
                'voice_print',
            ]);

            // Capture
            $table->text('biometric_data')->nullable();      // Base64 encoded or encrypted payload
            $table->string('biometric_file_path')->nullable(); // If stored as file
            $table->string('capture_device')->nullable();    // Device model/serial used
            $table->foreignId('captured_by')->constrained('users');
            $table->timestamp('captured_at');

            // Verification Status
            $table->enum('status', [
                'not_captured',
                'pending_verification',
                'verified',
                'failed',
            ])->default('not_captured');
            $table->decimal('match_score', 5, 2)->nullable(); // e.g. 98.75 (percentage confidence)
            $table->decimal('match_threshold', 5, 2)->nullable(); // Minimum passing score
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->text('failure_reason')->nullable();

            // Quality
            $table->decimal('quality_score', 5, 2)->nullable(); // Capture quality rating
            $table->unsignedTinyInteger('attempt_number')->default(1); // Which capture attempt

            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'biometric_type']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_biometrics');
    }
};

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
        Schema::create('kyc_screenings', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Screening Type
            $table->enum('screening_type', [
                'sanctions',        // OFAC, UN, EU lists
                'adverse_media',    // Negative news screening
                'pep',              // Politically Exposed Person check
                'credit',           // Credit bureau check
                'fraud',            // Internal fraud list
            ]);

            // Provider
            $table->string('provider')->nullable(); // e.g. "Refinitiv", "Dow Jones", "GhCreditBureau"
            $table->string('provider_reference')->nullable(); // Their transaction/request ID

            // Outcome
            $table->enum('status', [
                'pending',
                'passed',
                'failed',
                'inconclusive',
                'requires_review',
            ])->default('pending');

            $table->json('risk_indicators')->nullable();   // Array of matched indicators
            $table->json('raw_result')->nullable();        // Full provider response payload
            $table->text('summary')->nullable();           // Human-readable summary of result
            $table->decimal('risk_score', 5, 2)->nullable(); // Numeric risk score if provided

            // Who triggered it
            $table->foreignId('screened_by')->nullable()->constrained('users'); // null = automated
            $table->timestamp('screened_at');

            // Validity (screenings expire and must be re-run)
            $table->timestamp('expires_at')->nullable();

            // Manual override (compliance officer can override a failed screening)
            $table->boolean('manually_overridden')->default(false);
            $table->foreignId('overridden_by')->nullable()->constrained('users');
            $table->timestamp('overridden_at')->nullable();
            $table->text('override_reason')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'screening_type']);
            $table->index('status');
            $table->index('expires_at');
            $table->index(['kyc_id', 'screening_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_screenings');
    }
};

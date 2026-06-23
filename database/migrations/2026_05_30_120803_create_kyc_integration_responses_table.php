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
        Schema::create('kyc_integration_responses', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Provider
            $table->enum('provider', [
                'nia',              // National Identification Authority
                'ghanapost',        // Ghana Post GPS
                'gh_credit_bureau', // Ghana Credit Bureau
                'refinitiv',        // Sanctions / AML screening
                'dow_jones',        // Adverse media
                'internal',         // Internal fraud/watchlist check
                'other',
            ]);
            $table->string('provider_label')->nullable(); // For 'other'

            // What service/endpoint was called
            $table->string('service_endpoint')->nullable(); // e.g. "/v1/verify/ghana-card"
            $table->string('service_action')->nullable();   // e.g. "ghana_card_verification"

            // External Reference IDs
            $table->string('provider_transaction_id')->nullable(); // Their reference
            $table->string('our_request_reference')->nullable();   // Our outbound reference

            // Request / Response
            $table->json('request_payload')->nullable();   // What we sent (sanitised — no raw biometrics)
            $table->json('response_payload')->nullable();  // What they returned
            $table->unsignedSmallInteger('http_status_code')->nullable();
            $table->boolean('is_success')->default(false);
            $table->text('error_message')->nullable();

            // Timing
            $table->timestamp('requested_at');
            $table->timestamp('responded_at')->nullable();
            $table->unsignedInteger('response_time_ms')->nullable(); // Latency tracking

            // Retry tracking
            $table->unsignedTinyInteger('attempt_number')->default(1);
            $table->uuid('parent_attempt_id')->nullable(); // Links retry to original attempt

            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'provider']);
            $table->index('provider_transaction_id');
            $table->index(['kyc_id', 'is_success']);
            $table->index('requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_integration_responses');
    }
};

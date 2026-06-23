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
        Schema::create('kyc_consents', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Consent Type — each consent is a separate, auditable row
            $table->enum('consent_type', [
                'data_processing',       // GDPR/DPA consent to process personal data
                'terms_and_conditions',  // Acceptance of T&Cs
                'credit_bureau_check',   // Consent to pull credit report
                'third_party_sharing',   // Consent to share data with partners
                'marketing',             // Consent to receive marketing comms
                'biometric_collection',  // Explicit consent for biometric data
                'electronic_signature',  // Consent to use e-signatures
            ]);

            // Consent State
            $table->boolean('is_given')->default(false);
            $table->timestamp('given_at')->nullable();
            $table->timestamp('withdrawn_at')->nullable(); // If they later revoke

            // Evidence of Consent
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('consent_method')->nullable(); // 'digital_form', 'physical_form', 'verbal'
            $table->string('document_reference')->nullable(); // Physical form ref if applicable

            // Version of the policy/T&C they consented to
            $table->string('policy_version')->nullable(); // e.g. "v2.3"
            $table->string('policy_url')->nullable();

            // Who recorded this
            // null = customer self-served; not null = staff recorded on behalf of customer
            $table->foreignId('recorded_by')->nullable()->constrained('users');

            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'consent_type']);
            $table->index(['kyc_id', 'is_given']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_consents');
    }
};

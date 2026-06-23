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
        Schema::create('kycs', function (Blueprint $table) {

            // Identity
            $table->uuid('kyc_id')->primary();
            $table->foreignUuid('cif_id')->constrained('cifs', 'cif_id')->cascadeOnDelete();
            $table->string('kyc_reference')->unique(); // KYC-2026-0001


            // Digital Address (Ghana Post GPS)
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('town')->nullable();
            $table->string('digital_address')->nullable(); // AK-123-4567
            $table->enum('digital_address_status', [
                'not_submitted',
                'pending_verification',
                'verified',
                'failed',
                'expired',
            ])->default('not_submitted');
            $table->timestamp('digital_address_verified_at')->nullable();
            $table->json('digital_address_coordinates')->nullable();


            // KYC Level & Classification
            $table->enum('kyc_level', [
                'simplified',
                'basic',
                'enhanced',
            ])->default('basic');

            // Core Verification Status
            $table->enum('verification_status', [
                'draft',
                'submitted',
                'under_review',
                'pending_documents',
                'verified',
                'rejected',
                'expired',
                'flagged',
            ])->default('draft');

            // Verification Checklist (quick boolean flags)

            // $table->boolean('address_verified')->default(false);
            // $table->boolean('biometric_verified')->default(false);
            // $table->boolean('photo_verified')->default(false);
            // $table->boolean('signature_verified')->default(false);


            // Risk Classification
            $table->enum('risk_rating', [
                'low',
                'medium',
                'high',
                'very_high',
            ])->default('medium');
            $table->json('risk_factors')->nullable(); // Array of specific risk indicators


            // PEP (Politically Exposed Person)
            $table->boolean('pep_status')->default(false);
            $table->text('pep_details')->nullable();


            // Validity & Renewal
            $table->date('verification_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('renewal_required')->default(false);
            $table->timestamp('renewal_reminder_sent_at')->nullable();

            // Internal Notes
            $table->text('verification_notes')->nullable();
            $table->integer('verification_attempts')->default(0);
            $table->timestamp('last_verification_attempt')->nullable();

            // Tier upgrade guidance
            $table->text('tier_upgrade_requirements')->nullable();

            $table->softDeletes(); // Regulatory — never hard delete
            $table->timestamps();


            // Constraint and Idempotency
            $table->unique('cif_id');

            // Indexes
            $table->index(['cif_id', 'verification_status']);
            $table->index('kyc_level');
            $table->index('verification_status');
            $table->index('expiry_date');
            $table->index('digital_address');
            $table->index(['risk_rating', 'pep_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kycs');
    }
};

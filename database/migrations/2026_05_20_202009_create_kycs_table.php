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
            $table->uuid('kyc_id')->primary();
            $table->foreignUuid('cif_id')->constrained('cifs')->cascadeOnDelete();
            $table->string('kyc_reference')->unique(); // Format : KYC-2026-0001

            // 2. Ghana Card Number Verification (National ID)
            $table->string('ghana_card_number')->nullable(); // Format: GHA -XXXXXXXXX-X
            $table->enum('ghana_card_status', [
                'not_submitted',
                'pending_verification',
                'verified',
                'failed',
                'expired'
            ])->default('not_submitted');
            $table->timestamp('ghana_card_verified_at')->nullable();
            $table->text('ghana_card_verification_response')->nullable(); // JSON Response from NIA Api

            // 3. Digital Address (Ghana Post GPS)
            $table->string('digital_address')->nullable(); // Format: AK-123-4567
            $table->enum('digital_address_status', [
                'not_submitted',
                'pending_verification',
                'verified',
                'failed',
                'expired'
            ])->default('not_submitted');
            $table->timestamp('digital_address_verified_at')->nullable();
            $table->json('digital_address_coordinates')->nullable(); // Lat/Long

            // 4. Biometric Data
            $table->text('fingerprint_data')->nullable(); // Base64 or file path
            $table->string('facial_photo_path')->nullable(); // Storage path
            $table->enum('biometric_status', [
                'not_captured',
                'pending_verification',
                'verified',
                'failed'
            ])->default('not_captured');
            $table->timestamp('biometric_captured_at')->nullable();

            // 5. Document Uploads
            $table->string('id_card_front_path')->nullable();
            $table->string('id_card_back_path')->nullable();
            $table->string('utility_bill_path')->nullable();
            $table->string('passport_photo_path')->nullable();
            $table->string('signature_path')->nullable();

            // For Businesses
            $table->string('business_cert_path')->nullable(); // Business Registration
            $table->string('tax_clearance_path')->nullable(); // TIN Certificate
            $table->string('directors_resolution_path')->nullable();

            // 6. Additional Documents (JSON array of paths)
            $table->json('additional_documents')->nullable();

            // 7. Verification Checklist
            $table->boolean('id_verified')->default(false);
            $table->boolean('address_verified')->default(false);
            $table->boolean('biometric_verified')->default(false);
            $table->boolean('photo_verified')->default(false);
            $table->boolean('signature_verified')->default(false);
            $table->boolean('source_of_funds_verified')->default(false);

            // 8. Risk Assessment
            $table->enum('risk_rating', [
                'low',
                'medium',
                'high',
                'very_high'
            ])->default('medium');
            $table->text('risk_factors')->nullable(); // JSON array of risk indicators
            $table->boolean('pep_status')->default(false); // Politically Exposed Person
            $table->text('pep_details')->nullable();

            // 9. AML/CFT Screening
            $table->boolean('sanctions_check_passed')->default(false);
            $table->timestamp('sanctions_checked_at')->nullable();
            $table->text('sanctions_check_result')->nullable(); // JSON response
            $table->boolean('adverse_media_check')->default(false);
            $table->timestamp('adverse_media_checked_at')->nullable();

            // 10. Source of Funds/Wealth
            $table->enum('source_of_funds', [
                'salary',
                'business_income',
                'investment',
                'inheritance',
                'gift',
                'pension',
                'other'
            ])->nullable();
            $table->text('source_of_funds_description')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('occupation')->nullable();
            $table->decimal('monthly_income', 15, 2)->nullable();

            // 11. KYC Level & Tier Management
            $table->integer('kyc_level')->default(1); // 1, 2, 3 (Simplified, Standard, Enhanced)
            $table->enum('kyc_tier', [
                'tier_1', // Basic - Low transaction limits
                'tier_2', // Standard - Medium limits
                'tier_3'  // Enhanced - Full access
            ])->default('tier_1');
            $table->text('tier_upgrade_requirements')->nullable(); // What's needed for next tier

            // 12. Verification Workflow
            $table->enum('verification_status', [
                'draft',
                'submitted',
                'under_review',
                'pending_documents',
                'verified',
                'rejected',
                'expired',
                'flagged'
            ])->default('draft');

            // 13. Maker-Checker Workflow
            $table->foreignId('submitted_by')->nullable()->constrained('users'); // Customer or Staff
            $table->timestamp('submitted_at')->nullable();

            $table->foreignId('reviewed_by')->nullable()->constrained('users'); // KYC Officer
            $table->timestamp('reviewed_at')->nullable();
            $table->text('reviewer_comments')->nullable();

            $table->foreignId('approved_by')->nullable()->constrained('users'); // Compliance Officer
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_comments')->nullable();

            $table->foreignId('rejected_by')->nullable()->constrained('users');
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();

            // 14. Validity & Renewal
            $table->date('verification_date')->nullable();
            $table->date('expiry_date')->nullable(); // KYC typically valid for 1-2 years
            $table->boolean('renewal_required')->default(false);
            $table->timestamp('renewal_reminder_sent_at')->nullable();

            // 15. Next of Kin / Emergency Contact
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_relationship')->nullable();
            $table->text('next_of_kin_address')->nullable();

            // 16. Consent & Declarations
            $table->boolean('data_consent_given')->default(false);
            $table->timestamp('data_consent_at')->nullable();
            $table->boolean('terms_accepted')->default(false);
            $table->timestamp('terms_accepted_at')->nullable();
            $table->ipAddress('consent_ip_address')->nullable();

            // 17. Audit Trail
            $table->text('verification_notes')->nullable(); // Internal notes
            $table->json('audit_log')->nullable(); // Track all changes
            $table->integer('verification_attempts')->default(0);
            $table->timestamp('last_verification_attempt')->nullable();

            // 18. Integration Metadata
            $table->string('nia_transaction_id')->nullable(); // National ID Authority
            $table->string('ghanapost_transaction_id')->nullable(); // GhanaPost GPS
            $table->json('third_party_responses')->nullable(); // API responses

            // 19. Flags & Alerts
            $table->boolean('requires_manual_review')->default(false);
            $table->text('manual_review_reason')->nullable();
            $table->boolean('fraud_alert')->default(false);
            $table->text('fraud_alert_details')->nullable();

            // 20. Security & Metadata
            $table->softDeletes(); // Regulatory requirement - never hard delete
            $table->timestamps();

            // Indexes for performance
            $table->index(['cif_id', 'verification_status']);
            $table->index('ghana_card_number');
            $table->index('digital_address');
            $table->index(['kyc_level', 'kyc_tier']);
            $table->index('verification_status');
            $table->index('expiry_date');
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

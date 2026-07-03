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
        Schema::create('kyc_aml', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Source of Funds / Employment
            $table->enum('source_of_funds', [
                'salary',
                'business_income',
                'investment',
                'inheritance',
                'gift',
                'pension',
                'other',
            ])->nullable();
            $table->text('description')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('occupation')->nullable();
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->boolean('is_verified')->default(false);

            // Flags & Alerts
            $table->boolean('fraud_alert')->default(false);
            $table->text('fraud_alert_details')->nullable();
            $table->boolean('requires_manual_review')->default(false);
            $table->text('manual_review_reason')->nullable();

            // Check sum verification
            $table->string('check_sum')->nullable();

            // Timestamps
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_amls');
    }
};

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
        Schema::create('kyc_next_of_kin', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Personal Information
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->enum('relationship', [
                'spouse',
                'parent',
                'child',
                'sibling',
                'grandparent',
                'aunt_uncle',
                'cousin',
                'friend',
                'other',
            ]);
            $table->string('relationship_description')->nullable(); // When 'other'

            // Address
            $table->text('residential_address')->nullable();
            $table->string('digital_address')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();

            // Identification
            $table->string('ghana_card_number')->nullable();
            $table->date('date_of_birth')->nullable();

            // Designation
            $table->boolean('is_primary')->default(false); // Primary next of kin
            $table->unsignedTinyInteger('order')->default(1); // Contact priority order

            // Recorded by
            $table->foreignId('recorded_by')->constrained('users');

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'is_primary']);
            $table->index(['kyc_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_next_of_kin');
    }
};

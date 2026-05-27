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
        Schema::create('cifs', function (Blueprint $table) {
            $table->uuid('cif_id')->primary();
            $table->string('cif_number')->unique(); // Format eg. Branch Code, Type Code, Padded Serial Number
            $table->enum('entity_type', ['individual', 'business', 'group'])->default('individual');

            // Personal Information
            $table->string('first_name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('official_name');
            $table->string('phone_number')->unique();
            $table->string('email')->nullable();
            $table->date('date_of_birth');
            $table->text('residential_address');

            // KYC Compliance
            // $table->string('gh_card_number')->unique();
            // $table->string('tax_id')->unique();
            $table->integer('kyc_level')->default(1);

            // Account Manager
            $table->foreignId('maker_id')->constrained('users'); // staff who opened the account
            $table->foreignId('checker_id')->nullable()->constrained('users'); // staff who approved the account
            $table->timestamp('approved_at')->nullable(); // the time and date the account was approved

            // Account Status Management
            $table->enum('status',[
                'draft',
                'pending_approval',
                'active',
                'suspended',
                'blacklisted'
            ])->default('draft');

            // Security
            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index(['cif_number', 'status']);
            // $table->index('id_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cifs');
    }
};

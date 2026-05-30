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
        Schema::create('kyc_documents', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // Document Classification
            $table->enum('document_type', [
                'ghana_card_photo',
                'passport_photo',
                'utility_bill',
                'signature',
                'business_certificate',
                'tax_clearance',
                'directors_resolution',
                'proof_of_income',
                'bank_statement',
                'other',
            ]);
            
            // Used when document_type = 'other', or to give any doc a human label
            $table->string('document_label')->nullable();

            // File Metadata
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size_bytes')->nullable();
            $table->string('storage_disk')->default('private'); // local, s3, etc.
            $table->string('checksum')->nullable(); // SHA256 for integrity

            // Upload Context
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamp('uploaded_at')->useCurrent();

            // Verification
            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->text('rejection_reason')->nullable();

            // Expiry (e.g. utility bills expire after 3 months)
            $table->date('document_expiry_date')->nullable();

            // Version control — if a document is re-uploaded
            $table->unsignedTinyInteger('version')->default(1);
            $table->uuid('supersedes_id')->nullable(); // Points to previous version

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'document_type']);
            $table->index('is_verified');
            $table->index('document_expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_documents');
    }
};

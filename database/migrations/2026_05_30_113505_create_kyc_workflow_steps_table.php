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
        Schema::create('kyc_workflow_steps', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // What happened
            $table->enum('action', [
                'created',
                'submitted',
                'assigned',           // Assigned to a KYC officer
                'reviewed',           // Initial review by CSO/KYC Officer
                'sent_for_approval',  // Escalated to Compliance/Branch Manager
                'approved',
                'rejected',
                'flagged',
                'document_requested', // Officer requested additional documents
                'document_received',
                'resubmitted',        // Customer resubmitted after rejection
                'expired',
                'renewed',
                'overridden',         // Manual compliance override
            ]);

            // Status transition — full history of every state change
            $table->string('from_status')->nullable(); // null on first step
            $table->string('to_status');

            // Who performed this step
            $table->foreignId('performed_by')->constrained('users');
            $table->string('performer_role')->nullable(); // CSO, KYC Officer, Compliance Officer, etc.
            $table->timestamp('performed_at');

            // Notes / Comments at this step
            $table->text('comments')->nullable();

            // If documents were requested at this step
            $table->json('documents_requested')->nullable(); // Array of document types

            // Duration (calculated: time from previous step to this one)
            $table->unsignedInteger('duration_minutes')->nullable();

            // SLA tracking
            $table->timestamp('sla_due_at')->nullable();  // When this step was due
            $table->boolean('sla_breached')->default(false);

            $table->timestamps();

            // Indexes
            $table->index(['kyc_id', 'performed_at']);
            $table->index(['kyc_id', 'action']);
            $table->index('performed_by');
            $table->index('sla_breached');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_workflow_steps');
    }
};

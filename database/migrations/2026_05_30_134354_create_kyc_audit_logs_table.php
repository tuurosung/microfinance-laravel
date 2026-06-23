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
        Schema::create('kyc_audit_logs', function (Blueprint $table) {

            // Note: auto-increment int, not UUID — audit logs are append-only
            // and high-volume; int PKs are faster to write and index.
            $table->id();

            $table->foreignUuid('kyc_id')->constrained('kycs', 'kyc_id')->cascadeOnDelete();

            // What happened
            $table->string('event');           // e.g. 'kyc.status_changed', 'kyc.document_uploaded'
            $table->string('description');     // Human-readable summary

            // What changed — null on creation events
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            // Context — which model/record within the KYC ecosystem changed
            $table->string('auditable_type')->nullable(); // e.g. 'App\Models\KycDocument'
            $table->string('auditable_id')->nullable();   // ID of the changed record

            // Who did it — nullable for system/automated events
            $table->foreignId('performed_by')->nullable()->constrained('users');
            $table->string('performer_role')->nullable();

            // Request context
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->string('request_id')->nullable(); // Correlation ID for distributed tracing

            // Regulatory hold — prevent deletion of certain log entries
            $table->boolean('is_immutable')->default(true);

            // Timestamp only — no updated_at, audit logs never change
            $table->timestamp('performed_at')->useCurrent();

            // Indexes
            $table->index(['kyc_id', 'performed_at']);
            $table->index('event');
            $table->index('performed_by');
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('performed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_audit_logs');
    }
};

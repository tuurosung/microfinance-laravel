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
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();

            $table->foreignUuid('account_id')->constrained('accounts', 'account_id');
            $table->unsignedBigInteger('amount_pesewas');
            $table->string('narration')->nullable();

            // String + backed-enum cast (not a MySQL ENUM) — statuses will
            // evolve and ALTER TABLE churn on a hot table is not worth it.
            $table->string('channel', 20);
            $table->string('status', 30)->index();

            $table->string('momo_provider', 20)->nullable();
            $table->string('wallet_number', 20)->nullable();

            $table->string('idempotency_key', 100)->unique();

            // $table->foreignId('lien_id')->nullable()->constrained('liens');

            $table->foreignId('maker_id')->constrained('users');
            $table->foreignId('checker_id')->nullable()->constrained('users');
            $table->timestamp('decided_at')->nullable();
            $table->string('rejection_reason', 500)->nullable();

            $table->uuid('ledger_reference')->nullable();

            $table->timestamps();

            $table->index(['account_id', 'status']);
            $table->index(['status', 'created_at']); // approval queue scan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};

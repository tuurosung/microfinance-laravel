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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();

            $table->foreignUuid('debit_account_id')->constrained('accounts', 'account_id');
            $table->foreignUuid('credit_account_id')->constrained('accounts', 'account_id');

            // Amount in pesewas
            $table->unsignedBigInteger('amount_pesewas');

            $table->enum('type', [
                'deposit','withdrawal', 'loan_disbursement',
                'repayment', 'reversal', 'lien_hold', 'lien_release', 'fee', 'interest'
            ]);

            $table->string('channel', 20)->default('counter')->index();

            $table->string("narration")->nullable();
            $table->date('value_date');
            $table->foreignId('posted_by')->constrained('users');

            $table->string('idempotency_hash')->unique();
            $table->string('integrity_hash');

            $table->foreignId('reversal_of')->nullable()->constrained('transactions');

            // Append-only: no updated_at, no softDeletes
            $table->timestamp('created_at')->useCurrent();

            $table->index(['debit_account_id','value_date']);
            $table->index(['credit_account_id','value_date']);
            $table->index('reference');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('account_id')->unique();
            $table->foreignUuid('institution_id')->nullable()->constrained('institutions');
            $table->string('account_number')->unique();

            $table->foreignUuid('cif_id')->nullable()->constrained('cifs', 'cif_id');

            $table->enum('account_type', [
                'susu',
                'savings',
                'current',
                'fixed_deposit',
                'loan_float',
                'interest_income',
                'cash_till',
                'momo_float'
            ])->default('savings');

            $table->unsignedBigInteger('minimum_balance_pesewas')->default(0);
            $table->unsignedBigInteger('liened_amount_pesewas')->default(0);

            $table->enum('mandate_type', ['sole', 'any_one', 'any_two'])->default('any_one');
            $table->enum('status', ['active', 'dormant', 'closed'])->default('active');

            // Every account row — customer or system — posts against a GL code.
            $table->foreignId('gl_account_id')->constrained('chart_of_accounts');

            $table->foreignId('opened_by')->constrained('users');
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('last_transaction_at')->nullable();
            $table->boolean('is_dormant')->default(false);

            $table->softDeletes();
            $table->timestamps();

            $table->index('account_type');
            $table->index('account_number');
        });

        // Schema::create('accounts', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('account_number')->unique();

        //     // Nullable: system accounts (till, MoMo floats, loan float,
        //     // interest income) have no owning customer.
        //     $table->foreignId('cif_id')->nullable()->constrained('cifs');

        //     $table->enum('account_type', [
        //         'savings',
        //         'current',
        //         'fixed_deposit',
        //         'loan_float',
        //         'interest_income',
        //         'cash_till',
        //         'momo_float',
        //     ]);

        //     $table->enum('status', ['active', 'dormant', 'suspended', 'closed'])->default('active');

        //     $table->unsignedBigInteger('minimum_balance_pesewas')->default(0);
        //     $table->enum('mandate_type', ['sole', 'any_one', 'any_two'])->default('sole');

        //     // Every account row — customer or system — posts against a GL code.
        //     $table->foreignId('gl_account_id')->constrained('chart_of_accounts');

        //     $table->foreignId('opened_by')->constrained('users');
        //     $table->timestamp('opened_date')->useCurrent();
        //     $table->timestamp('last_transaction_at')->nullable();
        //     $table->boolean('is_dormant')->default(false);

        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->index(['cif_id', 'account_type']);
        //     $table->index('account_number');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_accounts');
    }
};

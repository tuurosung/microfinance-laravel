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
        Schema::create('deposit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('institution_id')->constrained('institutions');
            $table->string('account_number')->unique();

            $table->enum('account_type', ['savings', 'current'])->default('savings');

            $table->unsignedBigInteger('minimum_balance_pesewas')->default(0);
            $table->unsignedBigInteger('liened_amount_pesewas')->default(0);

            $table->enum('mandate_type', ['sole', 'any_one', 'any_two'])->default('any_one');
            $table->enum('status', ['active', 'dormant', 'closed'])->default('active');

            $table->foreignId('opened_by')->constrained('users');
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('last_transaction_at')->nullable();
            $table->boolean('is_dormant')->default(false);

            $table->softDeletes();
            $table->timestamps();

            $table->index('account_type');
            $table->index('account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_accounts');
    }
};

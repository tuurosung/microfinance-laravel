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
        Schema::create('deposit_account_cif', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('institution_id')->constrained('institutions');
            $table->foreignId('deposit_account_id')->constrained('deposit_accounts');
            $table->foreignUuid('cif_id')->constrained('cifs');
            $table->enum('role', ['primary', 'joint', 'signatory', 'director', 'trustee']);
            $table->boolean('can_transact')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_account_cif');
    }
};

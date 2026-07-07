<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 1120  Mobile Money Floats            (group, non-posting)
     * ├── 1121  MTN MoMo Float             (posting)
     * └── 1122  Telecel Cash Float         (posting)
     *
     * Also widens accounts.account_type: the original enum had no value for
     * the cash till or the MoMo floats, so the system accounts referenced by
     * Account::cashTill() / Account::momoFloat() had nowhere legal to live.
     */
    public function up(): void
    {
        // DB::statement("
        //     ALTER TABLE accounts MODIFY account_type ENUM(
        //         'savings', 'current', 'fixed_deposit',
        //         'loan_float', 'interest_income', 'cash_till', 'momo_float'
        //     ) NOT NULL
        // ");

        // DB::statement('ALTER TABLE accounts MODIFY cif_id BIGINT UNSIGNED NULL');

        $parentId = DB::table('chart_of_accounts')->where('code', '1100')->value('id');

        DB::table('chart_of_accounts')->insertOrIgnore([
            'code'       => '1120',
            'name'       => 'Mobile Money Floats',
            'type'       => 'asset',
            'parent_id'  => $parentId,
            'is_system'  => true,
            'is_posting' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $groupId = DB::table('chart_of_accounts')->where('code', '1120')->value('id');

        DB::table('chart_of_accounts')->insertOrIgnore([
            [
                'code' => '1121',
                'name' => 'MTN MoMo Float',
                'type' => 'asset',
                'parent_id' => $groupId,
                'is_system' => true,
                'is_posting' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '1122',
                'name' => 'Telecel Cash Float',
                'type' => 'asset',
                'parent_id' => $groupId,
                'is_system' => true,
                'is_posting' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('chart_of_accounts')->whereIn('code', ['1121', '1122', '1120'])->delete();

        DB::statement("
            ALTER TABLE accounts MODIFY account_type ENUM(
                'savings', 'current', 'fixed_deposit',
                'loan_float', 'interest_income'
            ) NOT NULL
        ");
    }
};

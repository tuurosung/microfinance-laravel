<?php

namespace Database\Seeders;

use App\Domain\Accounts\Models\Account;
use App\Domain\Accounts\Models\ChartOfAccount;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Ensures the bank's internal posting accounts exist and are linked to
 * their GL codes. Idempotent — keyed on gl_account_id.
 */
class SystemAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $systemUserId = (int) (config('mycro.banking.system_user_id') ?? User::query()->orderBy('id')->value('id'));

        $systemAccounts = [
            ['gl_code' => '1110', 'number' => 'SYS-CASH-TILL',     'type' => 'cash_till'],
            ['gl_code' => '1210', 'number' => 'SYS-LOAN-FLOAT',    'type' => 'loan_float'],
            ['gl_code' => '4100', 'number' => 'SYS-INT-INCOME',    'type' => 'interest_income'],
            ['gl_code' => '1121', 'number' => 'SYS-MOMO-MTN',      'type' => 'momo_float'],
            ['gl_code' => '1122', 'number' => 'SYS-MOMO-TELECEL',  'type' => 'momo_float'],
        ];

        foreach ($systemAccounts as $definition) {
            $gl = ChartOfAccount::where('code', $definition['gl_code'])->firstOrFail();

            Account::firstOrCreate(
                ['gl_account_id' => $gl->id],
                [
                    'account_id'=> Str::uuid(),
                    'account_number' => $definition['number'],
                    'cif_id'         => null, // system accounts have no CIF — see NOTES.md
                    'account_type'   => $definition['type'],
                    'status'         => 'active',
                    'opened_by'      => $systemUserId,
                ],
            );

        }
    }
}

<?php

namespace Database\Seeders;

use App\Domain\Accounts\Models\ChartOfAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = ChartOfAccount::create([
            'code' => '1000',
            'name' => 'Assets',
            'type' => 'asset',
            'parent_id' => null,
            'is_system' => true,
            'is_posting' => false,
        ]);

        $cash = ChartOfAccount::create([
            'code' => '1100',
            'name' => 'Cash & Cash Equivalents',
            'type' => 'asset',
            'parent_id' => $assets->id,
            'is_system' => true,
            'is_posting' => false,
        ]);

        ChartOfAccount::create([
            'code' => '1110',
            'name' => 'Cash in Till',
            'type' => 'asset',
            'parent_id' => $cash->id,
            'is_system' => true,
            'is_posting' => true,
        ]);

        $loansReceivable = ChartOfAccount::create([
            'code' => '1200',
            'name' => 'Loans Receivable',
            'type' => 'asset',
            'parent_id' => $assets->id,
            'is_system' => true,
            'is_posting' => false,
        ]);

        ChartOfAccount::create([
            'code' => '1210',
            'name' => 'Loan Float',
            'type' => 'asset',
            'parent_id' => $loansReceivable->id,
            'is_system' => true,
            'is_posting' => true,
        ]);

        $liabilities = ChartOfAccount::create([
            'code' => '2000',
            'name' => 'Liabilities',
            'type' => 'liability',
            'parent_id' => null,
            'is_system' => true,
            'is_posting' => false,
        ]);

        $deposits = ChartOfAccount::create([
            'code' => '2100',
            'name' => 'Customer Deposits',
            'type' => 'liability',
            'parent_id' => $liabilities->id,
            'is_system' => true,
            'is_posting' => false,
        ]);

        ChartOfAccount::create([
            'code' => '2110',
            'name' => 'Savings Accounts',
            'type' => 'liability',
            'parent_id' => $deposits->id,
            'is_system' => false,
            'is_posting' => true,
        ]);

        ChartOfAccount::create([
            'code' => '2120',
            'name' => 'Current Accounts',
            'type' => 'liability',
            'parent_id' => $deposits->id,
            'is_system' => false,
            'is_posting' => true,
        ]);

        ChartOfAccount::create([
            'code' => '2130',
            'name' => 'Fixed Deposits',
            'type' => 'liability',
            'parent_id' => $deposits->id,
            'is_system' => false,
            'is_posting' => true,
        ]);

        $income = ChartOfAccount::create([
            'code' => '4000',
            'name' => 'Income',
            'type' => 'income',
            'parent_id' => null,
            'is_system' => true,
            'is_posting' => false,
        ]);

        ChartOfAccount::create([
            'code' => '4100',
            'name' => 'Interest Income',
            'type' => 'income',
            'parent_id' => $income->id,
            'is_system' => true,
            'is_posting' => true,
        ]);
    }
}

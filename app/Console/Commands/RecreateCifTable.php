<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

#[Signature('app:recreate-cif-table')]
#[Description('Command description')]
class RecreateCifTable extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->recreateCifTable();
    }

    // drop table and re-run migration
    protected function recreateCifTable()
    {
        $this->info('Dropping CIF table...');

        // set foreign key locks to 0
        Schema::disableForeignKeyConstraints();

        // drop table
        Schema::dropIfExists('cifs');
        Schema::dropIfExists('kycs');
        Schema::dropIfExists('kyc_aml');
        Schema::dropIfExists('kyc_documents');
        Schema::dropIfExists('kyc_ghana_cards');

        Schema::dropIfExists('accounts');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('chart_of_accounts');
        Schema::dropIfExists('accounts');


        // get miration up function
        $cif_migration = database_path('migrations/2026_05_14_094950_create_cifs_table.php');
        $kyc_migration = database_path('migrations/2026_05_20_202009_create_kycs_table.php');
        $kyc_aml_migration = database_path('migrations/2026_05_30_181638_create_kyc_amls_table.php');
        $kyc_documents_migration = database_path('migrations/2026_05_30_033031_create_kyc_documents_table.php');
        $kyc_ghana_card_migration = database_path('migrations/2026_05_30_181813_create_kyc_ghana_cards_table.php');


        $transactions_migration = database_path('migrations/2026_07_03_165021_create_transactions_table.php');
        $accounts_migration = database_path('migrations/2026_06_03_011541_create_accounts_table.php');
        $chart_of_accounts_migration = database_path('migrations/2026_07_06_012304_create_chart_of_accounts_table.php');
        $momo_float_migration = database_path('migrations/2026_07_06_024721_create_momo_float_accounts_to_coa.php');


        $migrations = [
            $cif_migration,
            $kyc_migration,
            $kyc_aml_migration,
            $kyc_documents_migration,
            $kyc_ghana_card_migration,

            $chart_of_accounts_migration,
            $accounts_migration,
            $transactions_migration,
            $momo_float_migration,
        ];


        foreach ($migrations as $migration) {
            $migration = require $migration;
            $migration->up();
        }


        // $migration = require $cif_migration;
        // $migration->up();

        // run kyc migration
        // $migration = require $kyc_migration;
        // $migration->up();

        // //

        // set foreign key locks to 1
        Schema::enableForeignKeyConstraints();


        // Seed chart of accounts
        Artisan::call('db:seed', [
            '--class' => 'ChartOfAccountSeeder',
        ]);

        // Seed SystemAccount
        Artisan::call('db:seed', [
            '--class'=> 'SystemAccountSeeder'
        ]);

        $this->info('CIF table recreated.');
    }
}

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


        // get miration up function
        $cif_migration = database_path('migrations/2026_05_14_094950_create_cifs_table.php');
        $kyc_migration = database_path('migrations/2026_05_20_202009_create_kycs_table.php');

        $migration = require $cif_migration;
        $migration->up();

        // run kyc migration
        $migration = require $kyc_migration;
        $migration->up();

        //

        // set foreign key locks to 1
        Schema::enableForeignKeyConstraints();

        $this->info('CIF table recreated.');
    }
}

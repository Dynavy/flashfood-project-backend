<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropAllTables extends Command
{
    protected $signature = 'db:drop-all-tables';
    protected $description = 'Drop all tables from the database';

    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];
            DB::statement("DROP TABLE `$tableName`");
            $this->info("Dropped table: $tableName");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->info('All tables have been dropped successfully.');
    }
}

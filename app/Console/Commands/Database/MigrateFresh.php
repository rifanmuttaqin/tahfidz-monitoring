<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:migrate:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan Migrasi Fresh Install';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Fresh Migrating DB.');

        // Update the Tenant DB Name in Configuration
        config()->set('database.connections.mysql.database', env('DB_DATABASE'));
        DB::connection('mysql')->reconnect();

        Artisan::call('migrate:fresh', [
            '--path' => 'database/migrations',
            '--force' => true
        ]);

        info('Fresh Migration Successful.');
    }
}

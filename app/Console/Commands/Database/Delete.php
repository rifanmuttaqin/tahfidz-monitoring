<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Delete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:delete {db_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus Database';

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
        $dbName = $this->argument('db_name');

        if ($dbName)
        {
            $this->line('Deleting DB : ' . $dbName . '.');

            // drop database if exists
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            {
                $process = new Process('C:\XAMPP\MYSQL\Bin\mysql -u ' . env('DB_USERNAME') . 
                                        ' -p' . env('DB_PASSWORD') . 
                                        ' -e "drop database if exists ' . $dbName . '"');
                $process->run();
            }
            else
            {
                $process = new Process('mysql -u ' . env('DB_USERNAME') . 
                                        ' -p' . env('DB_PASSWORD') . 
                                        ' -e "drop database if exists ' . $dbName . '"');
                $process->run();
            }

            // executes after the command finishes
            if (!$process->isSuccessful())
            {
                $this->line($process->getOutput());
                throw new ProcessFailedException($process);
            }
        }
        else
        {
            $this->line('Invalid DB given.');
        }
    }
}

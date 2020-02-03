<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tahfidz:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proses Instalasi Tahfidz';

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
        $this->line('--------------- Instalasi TAHFIDZ APP ----------------');

        $this->line('Menghapus Database Tahfidz Lama.');
        Artisan::call('database:delete', ['db_name' => env('DB_DATABASE')]);

        $this->line('Membuat Database TAHFIDZ');
        Artisan::call('database:create', ['db_name' => env('DB_DATABASE')]);

        $this->line('Menjalankan Migrasi Database (Fresh Install).');
        $this->line('Butuh beberapa saat mohon bersabar......');
        Artisan::call('database:migrate:fresh');

        $this->line('Menyuntikan User Ke Database.');
        Artisan::call('database:user:seed');

        $this->line('Menyuntikan Role Ke Database.');
        $this->line('Butuh beberapa saat mohon bersabar......');
        Artisan::call('database:role:seed');

        $this->line('Membuat key Laravel......');
        Artisan::call('key:generate');

        $path = public_path().'/storage';
        
        $this->line('Mencoba mengecek Storange Link......');
        
        if (!file_exists($path)) {
            Artisan::call('storage:link');
            $this->line('Sorage dibuat......');
        }
        else
        {
            $this->line('Sorage Telah ada......');
        }

        $this->line('Instalasi telah selesai, Selamat Menggunakan TAHFIDZ MONITORING SEMOGA Bermanfaat.');
    }
}

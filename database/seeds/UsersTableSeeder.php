<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user')->insert([
            'username' => 'rifan',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('Jember123'),
            'full_name' => Str::random(10),
            'status' => 10,
            'account_type' => 10
        ]);
    }
}
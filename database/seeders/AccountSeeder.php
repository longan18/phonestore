<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert(
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]
        );

        DB::table('users')->truncate();
        DB::table('users')->insert(
            [
                'email' => 'longan@gmail.com',
                'password' => bcrypt('123456')
            ]
        );
    }
}

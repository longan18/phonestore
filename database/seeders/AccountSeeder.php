<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('users')->insert(
            [
                'name' => 'Vũ Long An',
                'phone' => '0396673333',
                'email' => 'longan@gmail.com',
                'password' => bcrypt('123456')
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['value' => '4 GB', 'created_at' => now()],
            ['value' => '6 GB', 'created_at' => now()],
            ['value' => '8 GB', 'created_at' => now()],
            ['value' => '12 GB', 'created_at' => now()]
        ];

        DB::table('rams')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorageCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['value' => '64 GB', 'created_at' => now()],
            ['value' => '128 GB', 'created_at' => now()],
            ['value' => '256 GB', 'created_at' => now()],
            ['value' => '512 GB', 'created_at' => now()],
            ['value' => '1 TB', 'created_at' => now()]
        ];

        DB::table('storage_capacities')->insert($data);
    }
}

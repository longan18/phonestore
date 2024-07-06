<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('brands')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('brands')->insert($this->fakeData());
    }

    /**
     * @return array
     */
    public function fakeData(): array
    {
        $name = [
            'Apple',
            'Samsung',
        ];

        return array_map(function($name) {
            return [
                'name'       => $name,
                'created_at' => now(),
            ];
        }, $name);
    }
}

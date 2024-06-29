<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Enums\StatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('categories')->insert(
            [
                'name' => 'Điện thoại thông minh',
                'status' => StatusEnum::StopSelling->value,
                'created_at' => now()->toDateTimeLocalString()
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['color' => 'Titan xanh', 'created_at' => now()],
            ['color' => 'Titan đen', 'created_at' => now()],
            ['color' => 'Titan tự nhiên','created_at' => now()],
            ['color' => 'Titan trắng', 'created_at' => now()],
            ['color' => 'Hồng nhạt', 'created_at' => now()],
            ['color' => 'Xanh dương nhạt', 'created_at' => now()],
            ['color' => 'Xanh lá nhạt', 'created_at' => now()],
            ['color' => 'Đen', 'created_at' => now()],
            ['color' => 'Vàng nhạt', 'created_at' => now()],
            ['color' => 'Xanh lá', 'created_at' => now()],
            ['color' => 'Hồng', 'created_at' => now()],
            ['color' => 'Trắng', 'created_at' => now()],
            ['color' => 'Xanh dương', 'created_at' => now()],
            ['color' => 'Tím', 'created_at' => now()],
            ['color' => 'Đỏ', 'created_at' => now()],
            ['color' => 'Bạc', 'created_at' => now()],
            ['color' => 'Tím nhạt', 'created_at' => now()],
            ['color' => 'Vàng', 'created_at' => now()],
            ['color' => 'Xanh rêu', 'created_at' => now()],
            ['color' => 'Kem', 'created_at' => now()],
            ['color' => 'Xám', 'created_at' => now()],
            ['color' => 'Xanh dương đậm', 'created_at' => now()],
            ['color' => 'Xanh lá mạ', 'created_at' => now()],
            ['color' => 'Xanh mint', 'created_at' => now()],
            ['color' => 'Tím nhạt', 'created_at' => now()],
        ];

        DB::table('colors')->insert($data);
    }
}

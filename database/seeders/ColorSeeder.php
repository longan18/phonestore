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
            ['color' => 'Titan xanh', 'hex_color' => '#9BB5CE', 'created_at' => now()],
            ['color' => 'Titan đen', 'hex_color' => '#000000', 'created_at' => now()],
            ['color' => 'Titan tự nhiên', 'hex_color' => '#F5F5F0', 'created_at' => now()],
            ['color' => 'Titan xanh', 'hex_color' => '#505F4E', 'created_at' => now()],
            ['color' => 'Titan trắng', 'hex_color' => '#FBF7F4', 'created_at' => now()],
            ['color' => 'Xanh lá nhạt', 'hex_color' => '#E1F8DC', 'created_at' => now()],
            ['color' => 'Xanh dương nhạt', 'hex_color' => '#B8DDFC', 'created_at' => now()],
            ['color' => 'Hồng nhạt', 'hex_color' => '#FAE6EF', 'created_at' => now()],
            ['color' => 'Vàng nhạt', 'hex_color' => '#F5F3CB', 'created_at' => now()],
            ['color' => 'Xanh dương', 'hex_color' => '#7298F2', 'created_at' => now()],
            ['color' => 'Xanh lá', 'hex_color' => '#69F5AA', 'created_at' => now()],
            ['color' => 'Hồng', 'hex_color' => '#F0CCD8', 'created_at' => now()],
            ['color' => 'Tím', 'hex_color' => '#D3ACE3', 'created_at' => now()],
            ['color' => 'Đỏ', 'hex_color' => '#F0356D', 'created_at' => now()],
            ['color' => 'Vàng', 'hex_color' => '#EEF277', 'created_at' => now()],
            ['color' => 'Bạc', 'hex_color' => '#D1CBCD', 'created_at' => now()],
            ['color' => 'Tím nhạt', 'hex_color' => '#E9CBF5', 'created_at' => now()],
            ['color' => 'Xám', 'hex_color' => '#B6B0B8', 'created_at' => now()],
            ['color' => 'Xanh dương đậm', 'hex_color' => '#3E6CED', 'created_at' => now()],
            ['color' => 'Xanh mint', 'hex_color' => '#9AE6DE', 'created_at' => now()],
            ['color' => 'Đỏ đô', 'hex_color' => '#EB96BB', 'created_at' => now()],
            ['color' => 'Titan xanh', 'hex_color' => '#215E7C', 'created_at' => now()],
        ];

        DB::table('colors')->insert($data);
    }
}

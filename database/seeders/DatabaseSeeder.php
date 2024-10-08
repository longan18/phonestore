<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seeder viet-nam map: php artisan vietnam-map:install
        $this->call([
            AccountSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            RamSeeder::class,
            StorageCapacitySeeder::class,
        ]);
    }
}

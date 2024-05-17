<?php

namespace Database\Seeders;

use App\Imports\ProductImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = __DIR__ . '/../imports/products.xlsx';
        Excel::import(new ProductImport, $file);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductSmartphoneImport;

class ProductSmartphoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = __DIR__ . '/../imports/product_smartphone.xlsx';
        Excel::import(new ProductSmartphoneImport, $file);
    }
}

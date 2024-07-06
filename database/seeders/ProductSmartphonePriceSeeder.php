<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductSmartphonepriceImport;

class ProductSmartphonePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = __DIR__ . '/../imports/product_smartphone_price.xlsx';
        Excel::import(new ProductSmartphonepriceImport, $file);
    }
}

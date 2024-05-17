<?php

namespace App\Imports;

use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Category\Models\Category;
use App\Modules\Admin\Product\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithColumnLimit;

class ProductImport implements ToModel, WithHeadingRow, WithColumnLimit
{
    /**
     * Specify title
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 2;
    }

    public function endColumn(): string
    {
        return 'E';
    }

    /**
     * @param array $row
     * @return Product|void
     */
    public function model(array $row)
    {
        // If ID is empty, do not import
        if (!isset($row['id'])) {
            return;
        }

        return new Product([
            'name' => $row['name'],
            'slug' => uuid(),
            'brand_id' => Brand::where('name', $row['brand_name'])->first()->id,
            'category_id' => Category::where('name', $row['category_name'])->first()->id,
        ]);
    }
}

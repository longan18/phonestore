<?php

namespace App\Imports;

use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductSmartphonepriceImport implements ToModel, WithHeadingRow, WithColumnLimit
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

    /**
     * @return string
     */
    public function endColumn(): string
    {
        return 'M';
    }

    /**
     * Import file
     *
     * @param array $row
     * @return ProductSmartphonePrice|void
     */
    public function model(array $row)
    {
        // If ID is empty, do not import
        if (!isset($row['id'])) {
            return;
        }

        return new ProductSmartphonePrice([
            'product_id' => $row['product_id'],
            'ram_id' => $row['ram_id'],
            'storage_capacity_id' => $row['storage_capacity_id'],
            'remaining_capacity_is_approx' => $row['remaining_capacity_is_approx'],
            'color_id' => $row['color_id'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
        ]);
    }
}

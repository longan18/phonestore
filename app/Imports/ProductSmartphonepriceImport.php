<?php

namespace App\Imports;

use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductSmartphonepriceImport implements ToModel, WithHeadingRow
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
            'item_id' => $row['item_id'],
            'ram' => $row['ram'],
            'storage_capacity' => $row['storage_capacity'],
            'remaining_capacity_is_approx' => $row['remaining_capacity_is_approx'],
            'color' => $row['color'],
            'hex_color' => $row['hex_color'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
        ]);
    }
}

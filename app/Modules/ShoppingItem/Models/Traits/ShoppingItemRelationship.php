<?php

namespace App\Modules\ShoppingItem\Models\Traits;

use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;

/**
 * @ShoppingItemRelationship
 */
trait ShoppingItemRelationship
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productPrice()
    {
        return $this->belongsTo(ProductSmartphonePrice::class, 'item_id', 'id');
    }
}

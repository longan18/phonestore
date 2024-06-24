<?php

namespace App\Modules\OrderItem\Models\Traits;

use App\Modules\Admin\OrderDetail\Models\OrderDetail;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;

/**
 * @OrderItemRelationship
 */
trait OrderItemRelationship
{
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productPrice()
    {
        return $this->belongsTo(ProductSmartphonePrice::class, 'item_id', 'id');

    }
}

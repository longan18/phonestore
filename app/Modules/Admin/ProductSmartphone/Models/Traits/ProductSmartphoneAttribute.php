<?php

namespace App\Modules\Admin\ProductSmartphone\Models\Traits;

/**
 * @ProductSmartphoneAttribute
 */
trait ProductSmartphoneAttribute
{
    public function getSmartphonePriceAttribute()
    {
        return $this->productSmartphonePrice;
    }
}

<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models\Traits;

/**
 * @ProductSmartphonePriceMethod
 */
trait ProductSmartphonePriceMethod
{
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
}

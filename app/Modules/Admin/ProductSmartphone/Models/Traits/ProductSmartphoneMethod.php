<?php

namespace App\Modules\Admin\ProductSmartphone\Models\Traits;

/**
 * @ProductSmartphoneMethod
 */
trait ProductSmartphoneMethod
{
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

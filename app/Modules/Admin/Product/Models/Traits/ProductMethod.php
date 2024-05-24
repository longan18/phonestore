<?php

namespace App\Modules\Admin\Product\Models\Traits;

/**
 * @ProductMethod
 */
trait ProductMethod
{
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

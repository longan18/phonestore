<?php

namespace App\Modules\OrderDetail\Models\Traits;

/**
 * @OrderDetailMethod
 */
trait OrderDetailMethod
{
    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}

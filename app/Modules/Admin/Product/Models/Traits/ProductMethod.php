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

    /**
     * @param $ids
     *
     * @return Collection
     */
    public function getSubImageByIdMethod($ids): Collection
    {
        return $this->media()->whereIn('id', $ids)->get();
    }
}

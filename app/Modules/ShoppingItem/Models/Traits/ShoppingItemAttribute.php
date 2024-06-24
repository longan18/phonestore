<?php

namespace App\Modules\ShoppingItem\Models\Traits;

/**
 * @ShoppingItemAttribute
 */
trait ShoppingItemAttribute
{
    public function getRamAttribute()
    {
        return $this->productPrice->ram;
    }

    public function getStorageCapacityAttribute()
    {
        return $this->productPrice->storageCapacity;
    }

    public function getColorAttribute()
    {
        return $this->productPrice->color;
    }
}

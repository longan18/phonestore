<?php

namespace App\Modules\Admin\Brand\Models\Traits;

use App\Modules\Admin\Product\Models\Product;

/**
 * @BrandRelationship
 */
trait BrandRelationship
{
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}

<?php

namespace App\Modules\Admin\ProductSmartphone\Models\Traits;

use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @ProductSmartphoneRelationship
 */
trait ProductSmartphoneRelationship
{
    /**
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    /**
     * @return HasMany
     */
    public function productSmartphonePrice(): HasMany
    {
        return $this->hasMany(ProductSmartphonePrice::class, 'item_id', 'id');
    }
}

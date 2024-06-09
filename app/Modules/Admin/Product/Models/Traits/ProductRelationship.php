<?php

namespace App\Modules\Admin\Product\Models\Traits;

use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Category\Models\Category;
use App\Modules\Admin\ProductSmartphone\Models\ProductSmartphone;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @ProductRelationship
 */
trait ProductRelationship
{
    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function productSmartphone(): HasOne
    {
        return $this->hasOne(ProductSmartphone::class, 'product_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function productSmartphonePrice(): HasMany
    {
        return $this->hasMany(ProductSmartphonePrice::class, 'product_id', 'id');
    }
}

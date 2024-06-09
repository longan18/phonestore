<?php

namespace App\Modules\Admin\ProductSmartphone\Models\Traits;

use App\Modules\Admin\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}

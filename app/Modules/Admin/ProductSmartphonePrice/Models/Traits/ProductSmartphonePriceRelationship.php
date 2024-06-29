<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models\Traits;

use App\Modules\Admin\Color\Models\Color;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Ram\Models\Ram;
use App\Modules\Admin\StorageCapacity\Models\StorageCapacity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @ProductSmartphonePriceRelationship
 */
trait ProductSmartphonePriceRelationship
{
    /**
     * @return BelongsTo
     */
    public function ram():BelongsTo
    {
        return $this->belongsTo(Ram::class, 'ram_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function storageCapacity():BelongsTo
    {
        return $this->belongsTo(StorageCapacity::class, 'storage_capacity_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\ProductSmartphonePrice\Models\Traits\ProductSmartphonePriceAttribute;
use App\Modules\Admin\ProductSmartphonePrice\Models\Traits\ProductSmartphonePriceScope;
use App\Modules\Admin\ProductSmartphonePrice\Models\Traits\ProductSmartphonePriceRelationship;
use App\Modules\Admin\ProductSmartphonePrice\Models\Traits\ProductSmartphonePriceMethod;

use Plank\Mediable\Mediable;

/**
 * @ProductSmartphonePrice
 *
 * TODO attribute model
 */
class ProductSmartphonePrice extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ProductSmartphonePriceAttribute,
         ProductSmartphonePriceScope,
         ProductSmartphonePriceRelationship,
         ProductSmartphonePriceMethod;

    protected $table = 'product_smartphone_price';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'ram_id',
        'storage_capacity_id',
        'remaining_capacity_is_approx',
        'color_id',
        'price',
        'quantity',
        'status',
    ];
}

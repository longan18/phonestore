<?php

namespace App\Modules\Admin\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Product\Models\Traits\ProductAttribute;
use App\Modules\Admin\Product\Models\Traits\ProductScope;
use App\Modules\Admin\Product\Models\Traits\ProductRelationship;
use App\Modules\Admin\Product\Models\Traits\ProductMethod;

use Plank\Mediable\Mediable;

/**
 * @Product
 *
 * TODO attribute model
 */
class Product extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ProductAttribute,
         ProductScope,
         ProductRelationship,
         ProductMethod;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'status',
        'slug'
    ];
}

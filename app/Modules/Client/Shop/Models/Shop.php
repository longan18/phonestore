<?php

namespace App\Modules\Client\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Client\Shop\Models\Traits\ShopAttribute;
use App\Modules\Client\Shop\Models\Traits\ShopScope;
use App\Modules\Client\Shop\Models\Traits\ShopRelationship;
use App\Modules\Client\Shop\Models\Traits\ShopMethod;

use Plank\Mediable\Mediable;

/**
 * @Shop
 *
 * TODO attribute model
 */
class Shop extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ShopAttribute,
         ShopScope,
         ShopRelationship,
         ShopMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

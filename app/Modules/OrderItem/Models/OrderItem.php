<?php

namespace App\Modules\OrderItem\Models;

use App\Modules\OrderItem\Models\Traits\OrderItemAttribute;
use App\Modules\OrderItem\Models\Traits\OrderItemMethod;
use App\Modules\OrderItem\Models\Traits\OrderItemRelationship;
use App\Modules\OrderItem\Models\Traits\OrderItemScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;

/**
 * @OrderItem
 *
 * TODO attribute model
 */
class OrderItem extends Model
{
     use HasFactory,
         Mediable,
         OrderItemAttribute,
         OrderItemScope,
         OrderItemRelationship,
         OrderItemMethod;

    protected $table = 'order_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_detail_id',
        'product_id',
        'item_id',
        'quantity',
        'price',
    ];
}

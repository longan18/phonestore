<?php

namespace App\Modules\OrderDetail\Models;

use App\Modules\OrderDetail\Models\Traits\OrderDetailAttribute;
use App\Modules\OrderDetail\Models\Traits\OrderDetailMethod;
use App\Modules\OrderDetail\Models\Traits\OrderDetailRelationship;
use App\Modules\OrderDetail\Models\Traits\OrderDetailScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;

/**
 * @OrderDetail
 *
 * TODO attribute model
 */
class OrderDetail extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         OrderDetailAttribute,
         OrderDetailScope,
         OrderDetailRelationship,
         OrderDetailMethod;

    protected $table = 'order_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'user_id',
        'address_shipping_id',
        'quantity_total',
        'price_total',
        'note',
        'status',
        'status_payment',
        'status_shipping',
    ];
}

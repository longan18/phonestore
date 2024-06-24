<?php

namespace App\Modules\OrderDetail\Models\Traits;

use App\Modules\Client\Account\Models\User;
use App\Modules\Client\Address\Models\AddressShipping;
use App\Modules\OrderItem\Models\OrderItem;

/**
 * @OrderDetailRelationship
 */
trait OrderDetailRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addressShipping()
    {
        return $this->belongsTo(AddressShipping::class, 'address_shipping_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_detail_id', 'id');
    }
}

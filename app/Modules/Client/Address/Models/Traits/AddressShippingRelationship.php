<?php

namespace App\Modules\Client\Address\Models\Traits;

use App\Modules\Client\Address\Models\Address;

trait AddressShippingRelationship
{
    public function address()
    {
        return $this->belongsTo(Address::class,'address_id', 'id');
    }
}

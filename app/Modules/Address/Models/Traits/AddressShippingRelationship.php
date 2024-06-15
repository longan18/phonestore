<?php

namespace App\Modules\Address\Models\Traits;

use App\Modules\Address\Models\Address;

trait AddressShippingRelationship
{
    public function address()
    {
        return $this->belongsTo(Address::class,'address_id', 'id');
    }
}

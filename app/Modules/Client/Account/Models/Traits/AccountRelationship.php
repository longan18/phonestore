<?php

namespace App\Modules\Client\Account\Models\Traits;

use App\Modules\Client\Address\Models\AddressShipping;

/**
 * @AccountRelationship
 */
trait AccountRelationship
{
    public function addressShippings()
    {
        return $this->hasMany(AddressShipping::class, 'user_id', 'id');
    }
}

<?php

namespace App\Modules\Client\Account\Models\Traits;

use App\Modules\Client\Address\Models\AddressShipping;
use App\Modules\ShoppingSession\Models\ShoppingSession;

/**
 * @AccountRelationship
 */
trait AccountRelationship
{
    public function addressShippings()
    {
        return $this->hasMany(AddressShipping::class, 'user_id', 'id');
    }

    public function shoppingSession()
    {
        return $this->hasOne(ShoppingSession::class, 'user_id', 'id');
    }
}

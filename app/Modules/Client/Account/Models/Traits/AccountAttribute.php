<?php

namespace App\Modules\Client\Account\Models\Traits;

/**
 * @AccountAttribute
 */
trait AccountAttribute
{
    public function getCountAddressAttribute()
    {
        return $this->addressShippings->count();
    }
}

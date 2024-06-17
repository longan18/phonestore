<?php

namespace App\Modules\Client\Address\Models\Traits;

trait AddressShippingAttribute
{
    public function getProvinceAttribute()
    {
        return $this->address->province->name;
    }

    public function getDistrictAttribute()
    {
        return $this->address->district->name;
    }

    public function getWardAttribute()
    {
        return $this->address->ward->name;
    }

    public function getAddressDetailAttribute()
    {
        return $this->address->address_detail;
    }
}

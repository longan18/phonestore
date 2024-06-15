<?php

namespace App\Modules\Address\Models\Traits;

use App\Modules\Address\Models\AddressShipping;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\Ward;

/**
 * @AddressRelationship
 */
trait AddressRelationship
{
    public function addressShippings()
    {
        return $this->hasMany(AddressShipping::class, 'address_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
}

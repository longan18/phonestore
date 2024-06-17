<?php

namespace App\Modules\Client\Address\Models;

use App\Modules\Client\Address\Models\Traits\AddressAttribute;
use App\Modules\Client\Address\Models\Traits\AddressMethod;
use App\Modules\Client\Address\Models\Traits\AddressRelationship;
use App\Modules\Client\Address\Models\Traits\AddressScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @Address
 *
 * TODO attribute model
 */
class Address extends Model
{
     use HasFactory,
         AddressAttribute,
         AddressScope,
         AddressRelationship,
         AddressMethod;

    protected $table = 'address';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ward_id',
        'district_id',
        'province_id',
        'address_detail',
    ];

    protected $with = [
        'province',
        'district',
        'ward',
    ];
}

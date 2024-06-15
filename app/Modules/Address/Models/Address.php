<?php

namespace App\Modules\Address\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Address\Models\Traits\AddressAttribute;
use App\Modules\Address\Models\Traits\AddressScope;
use App\Modules\Address\Models\Traits\AddressRelationship;
use App\Modules\Address\Models\Traits\AddressMethod;

use Plank\Mediable\Mediable;

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

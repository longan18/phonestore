<?php

namespace App\Modules\Client\Address\Models;

use App\Modules\Client\Address\Models\Traits\AddressShippingAttribute;
use App\Modules\Client\Address\Models\Traits\AddressShippingRelationship;
use Illuminate\Database\Eloquent\Model;

class AddressShipping extends Model
{
    use AddressShippingRelationship, AddressShippingAttribute;

    protected $table = 'address_shipping';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'address_id',
        'active',
    ];
}

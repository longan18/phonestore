<?php

namespace App\Modules\Address\Models;

use App\Modules\Address\Models\Traits\AddressShippingAttribute;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Address\Models\Traits\AddressShippingRelationship;

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

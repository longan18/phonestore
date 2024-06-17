<?php

namespace App\Modules\Admin\Address\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Address\Models\Traits\AddressAttribute;
use App\Modules\Admin\Address\Models\Traits\AddressScope;
use App\Modules\Admin\Address\Models\Traits\AddressRelationship;
use App\Modules\Admin\Address\Models\Traits\AddressMethod;

use Plank\Mediable\Mediable;

/**
 * @Address
 *
 * TODO attribute model
 */
class Address extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         AddressAttribute,
         AddressScope,
         AddressRelationship,
         AddressMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

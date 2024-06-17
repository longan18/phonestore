<?php

namespace App\Modules\Admin\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Customer\Models\Traits\CustomerAttribute;
use App\Modules\Admin\Customer\Models\Traits\CustomerScope;
use App\Modules\Admin\Customer\Models\Traits\CustomerRelationship;
use App\Modules\Admin\Customer\Models\Traits\CustomerMethod;

use Plank\Mediable\Mediable;

/**
 * @Customer
 *
 * TODO attribute model
 */
class Customer extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         CustomerAttribute,
         CustomerScope,
         CustomerRelationship,
         CustomerMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

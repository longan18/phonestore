<?php

namespace App\Modules\Admin\StorageCapacity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\StorageCapacity\Models\Traits\StorageCapacityAttribute;
use App\Modules\Admin\StorageCapacity\Models\Traits\StorageCapacityScope;
use App\Modules\Admin\StorageCapacity\Models\Traits\StorageCapacityRelationship;
use App\Modules\Admin\StorageCapacity\Models\Traits\StorageCapacityMethod;

use Plank\Mediable\Mediable;

/**
 * @StorageCapacity
 *
 * TODO attribute model
 */
class StorageCapacity extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         StorageCapacityAttribute,
         StorageCapacityScope,
         StorageCapacityRelationship,
         StorageCapacityMethod;

    protected $table = 'storage_capacities';

    protected $primaryKey = 'id';

    protected $fillable = ['value'];
}

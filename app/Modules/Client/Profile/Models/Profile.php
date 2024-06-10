<?php

namespace App\Modules\Client\Profile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Client\Profile\Models\Traits\ProfileAttribute;
use App\Modules\Client\Profile\Models\Traits\ProfileScope;
use App\Modules\Client\Profile\Models\Traits\ProfileRelationship;
use App\Modules\Client\Profile\Models\Traits\ProfileMethod;

use Plank\Mediable\Mediable;

/**
 * @Profile
 *
 * TODO attribute model
 */
class Profile extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ProfileAttribute,
         ProfileScope,
         ProfileRelationship,
         ProfileMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

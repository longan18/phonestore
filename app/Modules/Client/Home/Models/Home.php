<?php

namespace App\Modules\Client\Home\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Client\Home\Models\Traits\HomeAttribute;
use App\Modules\Client\Home\Models\Traits\HomeScope;
use App\Modules\Client\Home\Models\Traits\HomeRelationship;
use App\Modules\Client\Home\Models\Traits\HomeMethod;

use Plank\Mediable\Mediable;

/**
 * @Home
 *
 * TODO attribute model
 */
class Home extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         HomeAttribute,
         HomeScope,
         HomeRelationship,
         HomeMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

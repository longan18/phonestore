<?php

namespace App\Modules\Admin\Color\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Color\Models\Traits\ColorAttribute;
use App\Modules\Admin\Color\Models\Traits\ColorScope;
use App\Modules\Admin\Color\Models\Traits\ColorRelationship;
use App\Modules\Admin\Color\Models\Traits\ColorMethod;

use Plank\Mediable\Mediable;

/**
 * @Color
 *
 * TODO attribute model
 */
class Color extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ColorAttribute,
         ColorScope,
         ColorRelationship,
         ColorMethod;

    protected $table = 'colors';

    protected $primaryKey = 'id';

    protected $fillable = ['color'];
}

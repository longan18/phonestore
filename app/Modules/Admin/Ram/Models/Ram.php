<?php

namespace App\Modules\Admin\Ram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Ram\Models\Traits\RamAttribute;
use App\Modules\Admin\Ram\Models\Traits\RamScope;
use App\Modules\Admin\Ram\Models\Traits\RamRelationship;
use App\Modules\Admin\Ram\Models\Traits\RamMethod;

use Plank\Mediable\Mediable;

/**
 * @Ram
 *
 * TODO attribute model
 */
class Ram extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         RamAttribute,
         RamScope,
         RamRelationship,
         RamMethod;

    protected $table = 'rams';

    protected $primaryKey = 'id';

    protected $fillable = ['value'];
}

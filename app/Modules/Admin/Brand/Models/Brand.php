<?php

namespace App\Modules\Admin\Brand\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Brand\Models\Traits\BrandAttribute;
use App\Modules\Admin\Brand\Models\Traits\BrandScope;
use App\Modules\Admin\Brand\Models\Traits\BrandRelationship;
use App\Modules\Admin\Brand\Models\Traits\BrandMethod;

use Plank\Mediable\Mediable;

/**
 * @Brand
 *
 * TODO attribute model
 */
class Brand extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         BrandAttribute,
         BrandScope,
         BrandRelationship,
         BrandMethod;

    protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'status'];
}

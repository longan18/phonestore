<?php

namespace App\Modules\Admin\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\Admin\Category\Models\Traits\CategoryAttribute;
use App\Modules\Admin\Category\Models\Traits\CategoryScope;
use App\Modules\Admin\Category\Models\Traits\CategoryRelationship;
use App\Modules\Admin\Category\Models\Traits\CategoryMethod;

use Plank\Mediable\Mediable;

/**
 * @Category
 *
 * TODO attribute model
 */
class Category extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         CategoryAttribute,
         CategoryScope,
         CategoryRelationship,
         CategoryMethod;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status'
    ];
}

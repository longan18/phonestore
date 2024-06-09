<?php

namespace App\Modules\ShoppingCart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\ShoppingCart\Models\Traits\ShoppingCartAttribute;
use App\Modules\ShoppingCart\Models\Traits\ShoppingCartScope;
use App\Modules\ShoppingCart\Models\Traits\ShoppingCartRelationship;
use App\Modules\ShoppingCart\Models\Traits\ShoppingCartMethod;

use Plank\Mediable\Mediable;

/**
 * @ShoppingCart
 *
 * TODO attribute model
 */
class ShoppingCart extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ShoppingCartAttribute,
         ShoppingCartScope,
         ShoppingCartRelationship,
         ShoppingCartMethod;

    protected $table = '';

    protected $primaryKey = '';

    protected $fillable = [];
}

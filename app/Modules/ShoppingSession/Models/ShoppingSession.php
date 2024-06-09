<?php

namespace App\Modules\ShoppingSession\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\ShoppingSession\Models\Traits\ShoppingSessionAttribute;
use App\Modules\ShoppingSession\Models\Traits\ShoppingSessionScope;
use App\Modules\ShoppingSession\Models\Traits\ShoppingSessionRelationship;
use App\Modules\ShoppingSession\Models\Traits\ShoppingSessionMethod;

use Plank\Mediable\Mediable;

/**
 * @ShoppingSession
 *
 * TODO attribute model
 */
class ShoppingSession extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ShoppingSessionAttribute,
         ShoppingSessionScope,
         ShoppingSessionRelationship,
         ShoppingSessionMethod;

    protected $table = 'shopping_sessions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'quantity_total',
        'price_total'
    ];
}

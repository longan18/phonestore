<?php

namespace App\Modules\ShoppingItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Modules\ShoppingItem\Models\Traits\ShoppingItemAttribute;
use App\Modules\ShoppingItem\Models\Traits\ShoppingItemScope;
use App\Modules\ShoppingItem\Models\Traits\ShoppingItemRelationship;
use App\Modules\ShoppingItem\Models\Traits\ShoppingItemMethod;

use Plank\Mediable\Mediable;

/**
 * @ShoppingItem
 *
 * TODO attribute model
 */
class ShoppingItem extends Model
{
     use HasFactory,
         SoftDeletes,
         Mediable,
         ShoppingItemAttribute,
         ShoppingItemScope,
         ShoppingItemRelationship,
         ShoppingItemMethod;

    protected $table = 'shopping_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'shopping_session_id',
        'product_id',
        'item_id',
        'quantity',
        'price',
    ];
}

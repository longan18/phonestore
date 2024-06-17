<?php

namespace App\Modules\ShoppingSession\Models\Traits;


use App\Modules\ShoppingItem\Models\ShoppingItem;

/**
 * @ShoppingSessionRelationship
 */
trait ShoppingSessionRelationship
{
    public function shoppingItems()
    {
        return $this->hasMany(ShoppingItem::class, 'shopping_session_id', 'id');
    }
}

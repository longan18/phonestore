<?php

namespace App\Modules\ShoppingItem\Interfaces;

/**
 * @ShoppingItemInterface
 */
interface ShoppingItemInterface
{
    public function updateOrCreateShoppingItem($shoppingSession, $data);
}

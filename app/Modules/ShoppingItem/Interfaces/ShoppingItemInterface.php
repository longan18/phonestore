<?php

namespace App\Modules\ShoppingItem\Interfaces;

/**
 * @ShoppingItemInterface
 */
interface ShoppingItemInterface
{
    public function updateOrCreateShoppingItem($shoppingSession, $data);

    public function getShoppingItemByShoppingSessionId($shoppingSessionId, $perPage = null, $page = null);

    public function updateUpsertShoppingItem($data);
}

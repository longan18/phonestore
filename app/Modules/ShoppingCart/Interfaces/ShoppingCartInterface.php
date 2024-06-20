<?php

namespace App\Modules\ShoppingCart\Interfaces;

/**
 * @ShoppingCartInterface
 */
interface ShoppingCartInterface
{
    public function storeCart($data);
    public function getCartByUser($userId);

    public function deleteItemCart($itemId);

    public function updateCartItem($request);
}

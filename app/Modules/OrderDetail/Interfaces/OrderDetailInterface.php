<?php

namespace App\Modules\OrderDetail\Interfaces;

/**
 * @OrderDetailInterface
 */
interface OrderDetailInterface
{
    public function storeOrder($shoppingSessionId);
    public function getOrderDetailByUserId($userId, $page = null, $perPage = null);
    public function updateStatusOrder($request);
    public function search($request);
}

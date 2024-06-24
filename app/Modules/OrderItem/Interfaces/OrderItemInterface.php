<?php

namespace App\Modules\OrderItem\Interfaces;

/**
 * @OrderItemInterface
 */
interface OrderItemInterface
{
    public function getOrderItemByOrderDetailId($orderDetailId, $perPage = null, $page = null);
}

<?php

namespace App\Modules\OrderItem\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;

/**
 * @OrderItemController
 */
class OrderItemController extends Controller
{
    protected $orderitem;

    /**
     * @param OrderItemInterface $orderitem
     */
    public function __construct(OrderItemInterface $orderitem)
    {
        $this->orderitem = $orderitem;
    }
}

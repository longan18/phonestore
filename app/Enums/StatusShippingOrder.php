<?php

namespace App\Enums;

use App\Enums\interfaces\textMsg;

enum StatusShippingOrder :int implements textMsg
{
    case ORDER_SHIP_WRATING = 1;
    case ORDER_SHIP_DELIVERING = 2;
    case ORDER_SHIP_SUCCESSFUL = 3;

    public function getText()
    {
        return match($this) {
            StatusShippingOrder::ORDER_SHIP_WRATING => __('Chờ giao hàng'),
            StatusShippingOrder::ORDER_SHIP_DELIVERING => __('Đang giao hàng'),
            StatusShippingOrder::ORDER_SHIP_SUCCESSFUL => __('Giao hàng thành công'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusShippingOrder::ORDER_SHIP_WRATING => 'text-warting',
            StatusShippingOrder::ORDER_SHIP_DELIVERING => 'text-delivering',
            StatusShippingOrder::ORDER_SHIP_SUCCESSFUL => 'text-success',
        };
    }
}

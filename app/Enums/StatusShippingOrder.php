<?php

namespace App\Enums;

use App\Enums\interfaces\Notification;
use App\Enums\interfaces\textMsg;

enum StatusShippingOrder :int implements textMsg, Notification
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

    public function getTextNoti($uuid)
    {
        return match($this) {
            StatusShippingOrder::ORDER_SHIP_WRATING =>  "Đơn hàng <b>$uuid</b> đang chờ vận chuyển.",
            StatusShippingOrder::ORDER_SHIP_DELIVERING => "Đơn hàng <b>$uuid</b> đang được giao.",
            StatusShippingOrder::ORDER_SHIP_SUCCESSFUL => "Đơn hàng <b>$uuid</b> đã vận chuyển thành công.",
        };
    }
}

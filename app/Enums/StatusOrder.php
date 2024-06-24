<?php

namespace App\Enums;

use App\Enums\interfaces\textMsg;

enum StatusOrder: int implements textMsg
{
    case ORDER_WRATING = 1;

    case ORDER_CONFIRMED = 2;
    case ORDER_CANCEL = 3;

    public function getText()
    {
        return match($this) {
            StatusOrder::ORDER_WRATING => __('Chờ xác nhận'),
            StatusOrder::ORDER_CONFIRMED => __('Đã xác nhận'),
            StatusOrder::ORDER_CANCEL => __('Bị hủy'),
        };
    }

    public function getTextAdmin()
    {
        return match($this) {
            StatusOrder::ORDER_WRATING => __('Chờ xác nhận'),
            StatusOrder::ORDER_CONFIRMED => __('Xác nhận'),
            StatusOrder::ORDER_CANCEL => __('Hủy đơn'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusOrder::ORDER_WRATING => 'text-warting',
            StatusOrder::ORDER_CONFIRMED => 'text-success',
            StatusOrder::ORDER_CANCEL => 'text-cancel',
        };
    }
}

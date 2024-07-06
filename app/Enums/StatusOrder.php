<?php

namespace App\Enums;

use App\Enums\interfaces\Notification;
use App\Enums\interfaces\textMsg;

enum StatusOrder: int implements textMsg, Notification
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

    public function getTextNoti($uuid)
    {
        return match($this) {
            StatusOrder::ORDER_WRATING => "Đơn hàng $uuid đã được tạo thành công, vui lòng chờ xác nhận đơn hàng",
            StatusOrder::ORDER_CONFIRMED => "Đơn hàng $uuid đã được xác nhận thành công, cửa hàng đang chuẩn bị đơn hàng của bạn!",
            StatusOrder::ORDER_CANCEL => "Đơn hàng $uuid đã bị hủy",
        };
    }
}

<?php

namespace App\Enums;

use App\Enums\interfaces\textMsg;

enum StatusPaymentOrder :int implements textMsg
{
    case ORDER_PAYMENT_UNPAID = 1;
    case ORDER_PAYMENT_PAID = 2;
    public function getText()
    {
        return match($this) {
            StatusPaymentOrder::ORDER_PAYMENT_UNPAID => __('Chưa thanh toán'),
            StatusPaymentOrder::ORDER_PAYMENT_PAID => __('Đã thanh toán'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusPaymentOrder::ORDER_PAYMENT_UNPAID => 'text-warting',
            StatusPaymentOrder::ORDER_PAYMENT_PAID => 'text-success',
        };
    }

}

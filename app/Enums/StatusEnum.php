<?php

namespace App\Enums;

use App\Enums\interfaces\colorBtn;
use App\Enums\interfaces\textMsg;

/**
 * Compatible with files
 * config/contants.php
 * public/common/common.js
 */
enum StatusEnum: int implements textMsg, colorBtn
{
    case STOP_SELLING = 1;
    case PUBLISH = 2;

    case UNKNOWN = 3;


    public function getText()
    {
        return match($this) {
            StatusEnum::PUBLISH => __('Đăng bán'),
            StatusEnum::STOP_SELLING => __('Dừng bán'),
            StatusEnum::UNKNOWN => __('Không xác định'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusEnum::PUBLISH => 'text-success',
            StatusEnum::STOP_SELLING => 'text-danger',
            StatusEnum::UNKNOWN => 'color-999595',
        };
    }

    public function getColorBtn()
    {
        return match($this) {
            StatusEnum::PUBLISH => 'bg-lg-FFF-20Ef0D',
            StatusEnum::STOP_SELLING => 'bg-lg-FFF-EF0D0D',
        };
    }
}

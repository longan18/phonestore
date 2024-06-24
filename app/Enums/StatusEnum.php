<?php

namespace App\Enums;

use App\Enums\interfaces\colorBtn;
use App\Enums\interfaces\textMsg;

enum StatusEnum: int implements textMsg, colorBtn
{
    case Publish = 2;

    case StopSelling = 1;


    public function getText()
    {
        return match($this) {
            StatusEnum::Publish => __('Đăng bán'),
            StatusEnum::StopSelling => __('Dừng bán'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusEnum::Publish => 'text-success',
            StatusEnum::StopSelling => 'text-danger',
        };
    }

    public function getColorBtn()
    {
        return match($this) {
            StatusEnum::Publish => 'bg-lg-FFF-20Ef0D',
            StatusEnum::StopSelling => 'bg-lg-FFF-EF0D0D',
        };
    }
}

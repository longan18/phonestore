<?php

namespace App\Enums;

use App\Enums\interfaces\textMsg;

enum StatusAccountEnum: int implements textMsg
{
    case IN_ACTIVE = 0;

    case ACTIVE = 1;

    public function getText()
    {
        return match($this) {
            StatusAccountEnum::IN_ACTIVE => __('Không hoạt động'),
            StatusAccountEnum::ACTIVE => __('Đang hoạt động'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusAccountEnum::IN_ACTIVE => 'text-danger',
            StatusAccountEnum::ACTIVE => 'text-success',
        };
    }

}

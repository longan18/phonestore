<?php

namespace App\Enums;

use App\Enums\interfaces\Notification;

enum NotiTypeEnum: int implements Notification
{
    case NEW_USER = 1;
    case NEW_PRODUCT = 2;
    case ORDER = 3;
    public function getTextNoti($name)
    {
        return match($this) {
            NotiTypeEnum::NEW_USER => "Chào mừng $name đã đến với cửa hàng điện thoại Trung Kính,
            chúc bạn có thể chọn được những sản phẩm phù hợp với mình tại cửa hàng",
            NotiTypeEnum::NEW_PRODUCT => "Sản $name đã có mặt tại cửa hàng, hãy mua sắm ngay nào",
        };
    }
}

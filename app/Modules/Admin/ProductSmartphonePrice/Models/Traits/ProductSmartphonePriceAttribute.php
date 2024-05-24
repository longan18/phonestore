<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models\Traits;

use App\Enums\TagMedia;

/**
 * @ProductSmartphonePriceAttribute
 */
trait ProductSmartphonePriceAttribute
{
    /**
     * @return mixed
     */
    public function getAvatarAttribute(): mixed
    {
        return optional($this->getMedia(TagMedia::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }
}

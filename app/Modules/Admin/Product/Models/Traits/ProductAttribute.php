<?php

namespace App\Modules\Admin\Product\Models\Traits;

use App\Enums\TagMedia;

/**
 * @ProductAttribute
 */
trait ProductAttribute
{
    /**
     * @return mixed
     */
    public function getAvatarAttribute(): mixed
    {
        return optional($this->getMedia(TagMedia::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    public function getSmartphoneAttribute()
    {
        return $this->productSmartphone;
    }
}

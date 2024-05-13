<?php

namespace App\Modules\Admin\Brand\Models\Traits;

use App\Enums\TagMedia;

/**
 * @BrandAttribute
 */
trait BrandAttribute
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

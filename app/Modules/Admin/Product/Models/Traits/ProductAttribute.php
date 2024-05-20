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

    /**
     * @return mixed
     */
    public function getSubImageAttribute(): mixed
    {
        $result = $this->getMedia(TagMedia::SubImage->value);

        return $result->map(
            function ($data) {
                return [
                    'id'  => $data->id,
                    'url' => $data->getUrl(),
                ];
            }
        );
    }

    public function getSmartphoneAttribute()
    {
        return $this->productSmartphone;
    }
}

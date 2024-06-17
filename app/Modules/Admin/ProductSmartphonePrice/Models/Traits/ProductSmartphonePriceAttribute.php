<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models\Traits;

use App\Enums\StatusEnum;
use App\Enums\TagMediaEnum;
use Illuminate\Support\Collection;

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
        return optional($this->getMedia(TagMediaEnum::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return Collection
     */
    public function getStatusActionAttribute()
    {
        $data = collect();

        switch ($this->status) {
            case StatusEnum::StopSelling->value:
                $data->text = StatusEnum::StopSelling->getText();
                $data->color = StatusEnum::StopSelling->getColor();
                $data->bg_btn = StatusEnum::StopSelling->getColorBtn();
                break;
            case StatusEnum::Publish->value:
                $data->text = StatusEnum::Publish->getText();
                $data->color = StatusEnum::Publish->getColor();
                $data->bg_btn = StatusEnum::Publish->getColorBtn();
                break;
        }

        return $data;
    }
}

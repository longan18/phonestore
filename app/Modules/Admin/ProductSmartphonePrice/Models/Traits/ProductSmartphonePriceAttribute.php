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
        return optional($this->getMedia(TagMediaEnum::THUMB_AVATAR_OPTION->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return mixed
     */
    public function getThumbOptionAttribute(): mixed
    {
        return optional($this->getMedia(TagMediaEnum::THUMB_OPTION->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return Collection
     */
    public function getStatusActionAttribute()
    {
        $data = collect();

        switch ($this->status) {
            case StatusEnum::STOP_SELLING->value:
                $data->text = StatusEnum::STOP_SELLING->getText();
                $data->color = StatusEnum::STOP_SELLING->getColor();
                $data->bg_btn = StatusEnum::STOP_SELLING->getColorBtn();
                break;
            case StatusEnum::PUBLISH->value:
                $data->text = StatusEnum::PUBLISH->getText();
                $data->color = StatusEnum::PUBLISH->getColor();
                $data->bg_btn = StatusEnum::PUBLISH->getColorBtn();
                break;
            case StatusEnum::UNKNOWN->value:
                $data->text = StatusEnum::UNKNOWN->getText();
                $data->color = StatusEnum::UNKNOWN->getColor();
                break;
        }

        return $data;
    }
}

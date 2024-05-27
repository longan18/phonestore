<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Models\Traits;

use App\Enums\Status;
use App\Enums\TagMedia;
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
        return optional($this->getMedia(TagMedia::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return Collection
     */
    public function getStatusActionAttribute()
    {
        $data = collect();

        switch ($this->status) {
            case Status::StopSelling->value:
                $data->text = Status::StopSelling->getText();
                $data->color = Status::StopSelling->getColor();
                $data->bg_btn = Status::StopSelling->getColorBtn();
                break;
            case Status::Publish->value:
                $data->text = Status::Publish->getText();
                $data->color = Status::Publish->getColor();
                $data->bg_btn = Status::Publish->getColorBtn();
                break;
        }

        return $data;
    }
}

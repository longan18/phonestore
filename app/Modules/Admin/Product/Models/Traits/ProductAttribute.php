<?php

namespace App\Modules\Admin\Product\Models\Traits;

use App\Enums\Status;
use App\Enums\TagMedia;
use Illuminate\Support\Collection;

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

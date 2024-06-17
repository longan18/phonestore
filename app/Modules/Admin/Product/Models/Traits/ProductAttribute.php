<?php

namespace App\Modules\Admin\Product\Models\Traits;

use App\Enums\StatusEnum;
use App\Enums\TagMediaEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        return optional($this->getMedia(TagMediaEnum::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return mixed
     */
    public function getSubImageAttribute(): mixed
    {
        $result = $this->getMedia(TagMediaEnum::SubImage->value);

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

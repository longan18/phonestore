<?php

namespace App\Modules\Client\Account\Models\Traits;

use App\Enums\StatusAccountEnum;
use App\Enums\TagMediaEnum;
use Illuminate\Support\Collection;

/**
 * @AccountAttribute
 */
trait AccountAttribute
{
    public function getAvatarAttribute()
    {
        return optional($this->getMedia(TagMediaEnum::Avatar->value)->first())->getUrl()
            ?? asset('admin_assets/images/avatar.jpeg');
    }

    public function getCountAddressAttribute()
    {
        return $this->addressShippings->count();
    }

    public function getCountShoppingItemAttribute()
    {
        return $this->shoppingSession->shoppingItems->count();
    }

    /**
     * @return Collection
     */
    public function getStatusActAttribute()
    {
        $data = collect();

        switch ($this->status) {
            case StatusAccountEnum::ACTIVE->value:
                $data->text = StatusAccountEnum::ACTIVE->getText();
                $data->color = StatusAccountEnum::ACTIVE->getColor();
                break;
            case StatusAccountEnum::IN_ACTIVE->value:
                $data->text = StatusAccountEnum::IN_ACTIVE->getText();
                $data->color = StatusAccountEnum::IN_ACTIVE->getColor();
                break;
        }

        return $data;
    }
}

<?php

namespace App\Enums;

use App\Enums\interfaces\Directory;

enum TagMediaEnum: string implements Directory
{
    case THUMB_AVATAR_PRODUCT = 'thumb-avatar-product';
    case THUMB_AVATAR_BRAND = 'thumb-avatar-brand';
    case THUMB_AVATAR_OPTION = 'thumb-avatar-option';
    case THUMB_OPTION = 'thumb-option-200x200';
    case SUB_IMAGE_PRODUCT = 'sub-image-product';

    public function getDirectory()
    {
        return match($this) {
            TagMediaEnum::THUMB_AVATAR_PRODUCT => 'product/thumb-avatar-product',
            TagMediaEnum::THUMB_AVATAR_BRAND => 'brand/thumb-avatar-brand',
            TagMediaEnum::THUMB_AVATAR_OPTION => 'product/thumb-avatar-option',
            TagMediaEnum::THUMB_OPTION => 'product/thumb-option-200-200',
            TagMediaEnum::SUB_IMAGE_PRODUCT => 'product/sub-image-product',
        };
    }
}

<?php

namespace App\Modules\ShoppingItem\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use App\Modules\ShoppingItem\Models\ShoppingItem;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ShoppingItemService
 */
class ShoppingItemService extends BaseService implements ShoppingItemInterface
{
    protected $media;

    /**
     * @param ShoppingItem $shoppingitem
     * @param MediaInterface $media
     */
    public function __construct(ShoppingItem $shoppingitem, MediaInterface $media)
    {
        $this->model = $shoppingitem;
        $this->media = $media;
    }
}

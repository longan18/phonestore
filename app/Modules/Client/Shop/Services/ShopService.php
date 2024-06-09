<?php

namespace App\Modules\Client\Shop\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Client\Shop\Interfaces\ShopInterface;
use App\Modules\Client\Shop\Models\Shop;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ShopService
 */
class ShopService extends BaseService implements ShopInterface
{
    protected $media;

    /**
     * @param Shop $shop
     * @param MediaInterface $media
     */
    public function __construct(Shop $shop, MediaInterface $media)
    {
        $this->model = $shop;
        $this->media = $media;
    }
}

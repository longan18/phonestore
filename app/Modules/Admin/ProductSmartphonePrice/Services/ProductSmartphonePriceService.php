<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ProductSmartphonePriceService
 */
class ProductSmartphonePriceService extends BaseService implements ProductSmartphonePriceInterface
{
    protected $media;

    /**
     * @param ProductSmartphonePrice $productsmartphoneprice
     * @param MediaInterface $media
     */
    public function __construct(ProductSmartphonePrice $productsmartphoneprice, MediaInterface $media)
    {
        $this->model = $productsmartphoneprice;
        $this->media = $media;
    }
}

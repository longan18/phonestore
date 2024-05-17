<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\ProductSmartphonePrice\Http\Requests\ProductSmartphonePriceRequest;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;

/**
 * @ProductSmartphonePriceController
 */
class ProductSmartphonePriceController extends Controller
{
    protected $productsmartphoneprice;

    /**
     * @param ProductSmartphonePriceInterface $productsmartphoneprice
     */
    public function __construct(ProductSmartphonePriceInterface $productsmartphoneprice)
    {
        $this->productsmartphoneprice = $productsmartphoneprice;
    }
}

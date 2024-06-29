<?php

namespace App\Modules\Client\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Client\Shop\Http\Requests\ShopRequest;
use App\Modules\Client\Shop\Interfaces\ShopInterface;
use App\Modules\Client\Shop\Models\Shop;

/**
 * @ShopController
 */
class ShopController extends Controller
{
    protected $shop;
    protected $productInterface;
    protected $productSmartphonePriceInterface;

    /**
     * @param ShopInterface $shop
     * @param ProductInterface $productInterface
     * @param ProductSmartphonePriceInterface $productSmartphonePriceInterface
     */
    public function __construct(
        ShopInterface $shop,
        ProductInterface $productInterface,
        ProductSmartphonePriceInterface $productSmartphonePriceInterface
    ){
        $this->shop = $shop;
        $this->productInterface = $productInterface;
        $this->productSmartphonePriceInterface = $productSmartphonePriceInterface;
    }

    public function showProductDetail(Product $product)
    {
        $product = $this->productInterface->getProductBySlug($product->slug);

        $dataResult = $this->productSmartphonePriceInterface->getOptionProduct($product->productSmartphonePrice);

        return view('client.product.detail', compact('product', 'dataResult'));
    }
}

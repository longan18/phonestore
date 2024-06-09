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
        $product = $this->productInterface->with([
            'productSmartphone',
            'productSmartphonePrice.ram',
            'productSmartphonePrice.storageCapacity',
            'productSmartphonePrice.color'
        ])->where('slug', $product->slug)->first();

        [
            $uniqueRamStorageCapacity,
            $idRamStorageCapacityArray,
            $uniqueColor,
            $priceArray,
            $actDefault,
            $ids
        ] = $this->optionUniqueDetail($product);

        return view('client.product.detail', compact(
                'product',
                'uniqueRamStorageCapacity',
                'idRamStorageCapacityArray',
                'uniqueColor',
                'priceArray',
                'actDefault',
                'ids'
            )
        );
    }

    public function getOptionPriceProductDetail(Request $request)
    {
        $products = $this->productSmartphonePriceInterface->getOptionProduct($request->all());

        [
            $uniqueRamStorageCapacity,
            $idRamStorageCapacityArray,
            $uniqueColor,
            $priceArray,
            $actDefault,
            $ids
        ] = $this->optionUniqueDetail($products);

        return $this->responseSuccess(
            data: [
                'colors' => $uniqueColor,
                'prices' => $priceArray,
                'default' => $actDefault,
                'ids' => $ids
            ]
        );
    }

    private function optionUniqueDetail($products)
    {
        $products = !empty($products->productSmartphonePrice) ? $products->productSmartphonePrice : $products;

        $uniqueRamStorageCapacity = [];
        $idRamStorageCapacityArray = [];
        $uniqueColor = [];
        $priceArray = [];
        $actDefault = [];
        $ids = [];

        foreach($products as $key => $item) {
            if (!$key) {
                $actDefault['price_default'] = $item->price;
                $actDefault['quantity_default'] = $item->quantity;
                $idRamDefault = $item->ram_id;
                $idStorageCapacityDefault = $item->storage_capacity_id;
            }

            $ram_storageCapacity = $item->ram->value.' - '.$item->storageCapacity->value;

            if (!in_array($ram_storageCapacity, $uniqueRamStorageCapacity)) {
                $uniqueRamStorageCapacity[$item->color_id] = $ram_storageCapacity;

                $idRamStorageCapacityArray[$item->color_id] = [
                    'ram_id' => $item->ram_id,
                    'storage_capacity_id' => $item->storage_capacity_id,
                ];
            }

            if ($item->ram_id == $idRamDefault &&
                $item->storage_capacity_id == $idStorageCapacityDefault &&
                !in_array($item->color->hex_color, $uniqueColor)
            ) {
                $uniqueColor[$item->color_id] = $item->color->hex_color;
                $priceArray[$item->color_id] = $item->price;
                $ids[$item->color_id] = $item->id;
            }
        }

        return [
            $uniqueRamStorageCapacity,
            $idRamStorageCapacityArray,
            $uniqueColor,
            $priceArray,
            $actDefault,
            $ids
        ];
    }
}

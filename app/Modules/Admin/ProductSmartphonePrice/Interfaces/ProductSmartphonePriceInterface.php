<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Interfaces;

/**
 * @ProductSmartphonePriceInterface
 */
interface ProductSmartphonePriceInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function handle($request);

    /**
     * @param $itemId
     * @return mixed
     */
    public function getByProductId($itemId);

    /**
     * @param $requestArray
     * @return mixed
     */
    public function getOptionProduct($productSmartphonePrice);

    public function deleteOption($id);
}

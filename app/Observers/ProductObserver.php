<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;

class ProductObserver
{
    protected $productSmartphonePrice;
    public function __construct(ProductSmartphonePriceInterface $productSmartphonePrice)
    {
        $this->productSmartphonePrice = $productSmartphonePrice;
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->status == StatusEnum::UNKNOWN->value) {
            $this->productSmartphonePrice->updateStatusByProductId($product->id, StatusEnum::UNKNOWN->value);
        }

        if ($product->status == StatusEnum::STOP_SELLING->value) {
            $this->productSmartphonePrice->updateStatusByProductId($product->id, StatusEnum::STOP_SELLING->value);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {

    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Product\Interfaces\ProductInterface;

class BrandObserver
{
    protected $product;
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Handle the Brand "created" event.
     */
    public function created(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        if ($brand->status == StatusEnum::UNKNOWN->value) {
            $this->product->updateStatusByBrandId($brand->id, StatusEnum::UNKNOWN->value);
        }

        if ($brand->status == StatusEnum::STOP_SELLING->value) {
            $this->product->updateStatusByBrandId($brand->id, StatusEnum::STOP_SELLING->value);
        }
    }

    /**
     * Handle the Brand "deleted" event.
     */
    public function deleted(Brand $brand): void
    {

    }

    /**
     * Handle the Brand "restored" event.
     */
    public function restored(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     */
    public function forceDeleted(Brand $brand): void
    {
        //
    }
}

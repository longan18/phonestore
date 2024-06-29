<?php

namespace App\Observers;

use App\Modules\Admin\Product\Models\Product;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;

class ProductObserver
{
    protected $shoppingItem;
    public function __construct(ShoppingItemInterface $shoppingItem)
    {
        $this->shoppingItem = $shoppingItem;
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
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $product->productSmartphone()->delete();
        $product->productSmartphonePrice()->delete();
        $product->shoppingItems()->delete();

        $shoppingItem = $this->shoppingItem->getShoppingItemByShoppingSessionId(userInfo()->shoppingSession->id);

        $dataUpdate = [
            'quantity_total' => $shoppingItem->count(),
            'price_total' => $shoppingItem->sum('total_price_item'),
        ];

        userInfo()->shoppingSession->update($dataUpdate);
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

<?php

namespace App\Modules\ShoppingItem\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use App\Modules\ShoppingItem\Models\ShoppingItem;
use App\Services\BaseService;

/**
 * @ShoppingItemService
 */
class ShoppingItemService extends BaseService implements ShoppingItemInterface
{
    protected $media;

    /**
     * @param ShoppingItem $shoppingitem
     */
    public function __construct(ShoppingItem $shoppingitem)
    {
        $this->model = $shoppingitem;
    }

    public function updateOrCreateShoppingItem($shoppingSession, $data)
    {
        $shoppingItem = $this->model->where('shopping_session_id', $shoppingSession)
            ->where('product_id', $data['product_id'])
            ->where('item_id', $data['item_id'])
            ->first();

        if ($shoppingItem == null) {
            $this->model->create([
                 'shopping_session_id' => $shoppingSession,
                 'product_id' => $data['product_id'],
                 'item_id' => $data['item_id'],
                 'quantity' => $data['quantity'],
                 'price' => $data['price'],
            ]);
        } else {
            $shoppingItem->update([
                'quantity' => $shoppingItem->quantity + $data['quantity'],
            ]);
        }

    }

    public function getShoppingItemByShoppingSessionId($shoppingSessionId)
    {
        return $this->model->with([
            'product',
            'productPrice.ram',
            'productPrice.storageCapacity',
            'productPrice.color',
        ])->where('shopping_session_id', $shoppingSessionId)
            ->groupBy('id') // Group by ID của ShoppingItem để tính tổng cho từng item
            ->select('shopping_items.*', DB::raw('shopping_items.quantity * SUM(price) as total_price_item')) // Chọn tất cả cột của ShoppingItem và thêm cột total_price
            ->get();
    }

    public function updateUpsertShoppingItem($data)
    {
        return $this->model::upsert($data['cartItems'], ['id']);
    }
}

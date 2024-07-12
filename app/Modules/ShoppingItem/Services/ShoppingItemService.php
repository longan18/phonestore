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

    public function getShoppingItemByShoppingSessionId($shoppingSessionId, $perPage = null, $page = null)
    {
        return $this->model->with([
            'productPrice.media',
            'product',
            'productPrice.ram',
            'productPrice.storageCapacity',
            'productPrice.color',
        ])->where('shopping_session_id', $shoppingSessionId)
            ->groupBy('id')
            ->select('shopping_items.*', DB::raw('shopping_items.quantity * SUM(price) as total_price_item'))
            ->paginate($perPage, page: $page);
    }

    public function updateUpsertShoppingItem($data)
    {
        return $this->model::upsert($data['cartItems'], ['id']);
    }

    public function getDataByIdOrShoppingSessionId($arrayId, $shoppingSessionId)
    {
        return $this->model->when(isset($arrayId), function ($query) use ($arrayId) {
            $query->whereIn('id', $arrayId);
        }, function ($query) use ($shoppingSessionId) {
            $query->where('shopping_session_id', $shoppingSessionId);
        })->get();
    }

    public function deleteDataById($arrayId)
    {
        return $this->model->whereIn('id', $arrayId)->delete();
    }
}

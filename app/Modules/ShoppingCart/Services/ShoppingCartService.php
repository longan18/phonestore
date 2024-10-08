<?php

namespace App\Modules\ShoppingCart\Services;

use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use App\Modules\ShoppingItem\Models\ShoppingItem;
use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingCart\Interfaces\ShoppingCartInterface;
use App\Modules\ShoppingCart\Models\ShoppingCart;
use App\Services\BaseService;

/**
 * @ShoppingCartService
 */
class ShoppingCartService extends BaseService implements ShoppingCartInterface
{
    protected $shoppingSession;
    protected $shoppingItem;
    protected $smartphonePrice;

    /**
     * @param ShoppingSessionInterface $shoppingSession
     * @param ShoppingItemInterface $shoppingItem
     * @param ProductSmartphonePrice $smartphonePrice
     */
    public function __construct(
        ShoppingSessionInterface $shoppingSession,
        ShoppingItemInterface $shoppingItem,
        ProductSmartphonePrice $smartphonePrice,
    ) {
        $this->shoppingSession = $shoppingSession;
        $this->shoppingItem = $shoppingItem;
        $this->smartphonePrice = $smartphonePrice;
    }

    public function storeCart($data)
    {
        $smartphonePrice = $this->smartphonePrice->where('id', $data['item_id'])->first();

        $dataShoppingSession = [
            'user_id' => userInfo()->id,
            'quantity_total' => $data['quantity'],
            'price_total' => $data['quantity'] * $smartphonePrice->price,
        ];

        $data['price'] = $smartphonePrice->price;

        DB::beginTransaction();
        try {
            if (!userInfo()->shoppingSession) {
                $shoppingSession = $this->shoppingSession->create($dataShoppingSession);
                $shoppingSession->shoppingItems()->create($data);
                $countShoppingItem = $shoppingSession->shoppingItems()->count();
                $totalPrice = $dataShoppingSession['price_total'];
            } else {
                userInfo()->shoppingSession->update([
                    'quantity_total' => userInfo()->shoppingSession->quantity_total + $dataShoppingSession['quantity_total'],
                    'price_total' => userInfo()->shoppingSession->price_total + $dataShoppingSession['price_total'],
                ]);

                $this->shoppingItem->updateOrCreateShoppingItem(userInfo()->shoppingSession->id, $data);
                $countShoppingItem = userInfo()->count_shopping_item;
                $totalPrice = userInfo()->shoppingSession->price_total;
            }

            DB::commit();

            return [
                'quantity_item' => $countShoppingItem,
                'total_price' => shorten_numbers($totalPrice),
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function getCartByUser($userId)
    {
        return $this->shoppingSession->with(['shoppingItems'])
            ->where('user_id', $userId)
            ->first();
    }

    public function deleteItemCart($itemId)
    {
        DB::beginTransaction();
        try {
            $this->shoppingItem->deleteById($itemId);
            $shoppingItem = $this->shoppingItem->getShoppingItemByShoppingSessionId(userInfo()->shoppingSession->id);

            $dataUpdate = [
                'quantity_total' => $shoppingItem->count(),
                'price_total' => $shoppingItem->sum('total_price_item'),
            ];

            userInfo()->shoppingSession->update($dataUpdate);

            DB::commit();
            return [
                'quantity_total' => $shoppingItem->count(),
                'price_total' => $shoppingItem->sum('total_price_item'),
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function updateCartItem($request)
    {
        DB::beginTransaction();
        try {
            $this->shoppingItem->updateUpsertShoppingItem($request);
            $shoppingItem = $this->shoppingItem->getShoppingItemByShoppingSessionId(userInfo()->shoppingSession->id);

            userInfo()->shoppingSession->update([
                'quantity_total' => $shoppingItem->count(),
                'price_total' => $shoppingItem->sum('total_price_item'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

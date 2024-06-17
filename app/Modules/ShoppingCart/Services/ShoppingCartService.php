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
            } else {
                userInfo()->shoppingSession->update([
                    'quantity_total' => userInfo()->shoppingSession->quantity_total + $dataShoppingSession['quantity_total'],
                    'price_total' => userInfo()->shoppingSession->price_total + $dataShoppingSession['price_total'],
                ]);

                $this->shoppingItem->updateOrCreateShoppingItem(userInfo()->shoppingSession->id, $data);
            }

            DB::commit();

            return [
                'quantity_item' => userInfo()->count_shopping_item,
                'total_price' => shorten_numbers(userInfo()->shoppingSession->price_total),
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

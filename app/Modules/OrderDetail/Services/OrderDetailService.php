<?php

namespace App\Modules\OrderDetail\Services;

use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use App\Modules\OrderDetail\Models\OrderDetail;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @OrderDetailService
 */
class OrderDetailService extends BaseService implements OrderDetailInterface
{
    protected $shoppingSession;
    protected $orderItem;

    /**
     * @param OrderDetail $orderdetail
     * @param ShoppingSessionInterface $shoppingSession
     * @param OrderItemInterface $orderItem
     */
    public function __construct(
        OrderDetail $orderdetail,
        ShoppingSessionInterface $shoppingSession,
        OrderItemInterface $orderItem,
    ){
        $this->model = $orderdetail;
        $this->shoppingSession = $shoppingSession;
        $this->orderItem = $orderItem;
    }

    public function storeOrder($requestArray)
    {
        $shoppingSession = $this->shoppingSession->where('id', $requestArray['shopping_session_id'])->first();
        $shoppingItems = $shoppingSession->shoppingItems->toArray();

        $dataOrderItem = [];
        $dataOrderDetail = [
            "uuid" => uuid(),
            "user_id" => $shoppingSession->user_id,
            "address_shipping_id" => $requestArray['address_shipping_id'],
            "quantity_total" => $shoppingSession->quantity_total,
            "price_total" => $shoppingSession->price_total,
            "note" => $requestArray['note'],
        ];

        DB::beginTransaction();
        try {
            $orderDetail = $this->model->create($dataOrderDetail);

            foreach ($shoppingItems as $shoppingItem) {
                $flag = [
                    'order_detail_id' => $orderDetail->id,
                    'product_id' => $shoppingItem['product_id'],
                    'item_id' => $shoppingItem['item_id'],
                    'quantity' => $shoppingItem['quantity'],
                    'price' => $shoppingItem['price'],
                ];

                array_push($dataOrderItem, $flag);
            }

            $this->orderItem->insert($dataOrderItem);
            $this->shoppingSession->deleteById($requestArray['shopping_session_id']);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function getOrderDetailByUserId($userId, $page = null, $perPage = null)
    {
        return $this->model->with([
            'user',
            'addressShipping',
        ])->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, page: $page);
    }

    public function search($params)
    {
        return $this->model->with('user')->whereHas('user', function($q) use($params) {
            $q->when(isset($params['key_search']), function($q) use($params) {
                $q->where('users.email', 'like', '%'. $params['key_search'] . '%')
                    ->orWhere('users.phone', 'like', '%'. $params['key_search'] . '%');
            });
        })
        ->when(isset($params['status']), function($q) use($params) {
            $q->where('status', $params['status']);
        })
        ->when(isset($params['status_payment']), function($q) use($params) {
            $q->where('status_payment', $params['status_payment']);
        })
        ->when(isset($params['status_shipping']), function($q) use($params) {
            $q->where('status_shipping', $params['status_shipping']);
        })
        ->when(isset($params['start_price']), function($q) use($params) {
            $q->where('price_total', '>=', str_replace(',', '', $params['start_price']));
        })
        ->when(isset($params['end_price']), function($q) use($params) {
            $q->where('price_total', '<=', str_replace(',', '', $params['end_price']));
        })
        ->when(isset($params['start_date']), function($q) use($params) {
            $q->where('created_at', '>=', date('Y-m-d', strtotime(str_replace('/', '-', $params['start_date']))));
        })
        ->when(isset($params['end_date']), function($q) use($params) {
            $q->where('created_at', '<=', date('Y-m-d', strtotime(str_replace('/', '-', $params['end_date']))));
        })
        ->orderBy('created_at', 'desc')
        ->paginate(3);
    }
}

<?php

namespace App\Modules\OrderDetail\Services;

use App\Enums\NotiTypeEnum;
use App\Enums\StatusEnum;
use App\Enums\StatusOrder;
use App\Enums\StatusShippingOrder;
use App\Mail\NewOrderMail;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use App\Modules\Notification\Interfaces\NotificationInterface;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use App\Modules\OrderDetail\Models\OrderDetail;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * @OrderDetailService
 */
class OrderDetailService extends BaseService implements OrderDetailInterface
{
    protected $shoppingSession;
    protected $orderItem;
    protected $productSmartphonePrice;
    protected $notification;
    protected $shoppingItem;

    /**
     * @param OrderDetail $orderdetail
     * @param ShoppingSessionInterface $shoppingSession
     * @param OrderItemInterface $orderItem
     * @param ProductSmartphonePriceInterface $productSmartphonePrice
     * @param NotificationInterface $notification
     * @param ShoppingItemInterface $shoppingItem
     */
    public function __construct(
        OrderDetail $orderdetail,
        ShoppingSessionInterface $shoppingSession,
        OrderItemInterface $orderItem,
        ProductSmartphonePriceInterface $productSmartphonePrice,
        NotificationInterface $notification,
        ShoppingItemInterface $shoppingItem
    ){
        $this->model = $orderdetail;
        $this->shoppingSession = $shoppingSession;
        $this->orderItem = $orderItem;
        $this->productSmartphonePrice = $productSmartphonePrice;
        $this->notification = $notification;
        $this->shoppingItem = $shoppingItem;
    }

    public function storeOrder($requestArray)
    {
        $shoppingSession = $this->shoppingSession->where('id', $requestArray['shopping_session_id'])->first();
        $shoppingItems = $this->shoppingItem->getDataByIdOrShoppingSessionId($requestArray['shopping_item_id'] ?? null, $shoppingSession->id)->toArray();

        $dataOrderItem = [];
        $sumPrice = 0;
        $qty = 0;

        $dataOrderDetail = [
            "uuid" => generateUUIDWithRandomString(),
            "user_id" => $shoppingSession->user_id,
            "address_shipping_id" => $requestArray['address_shipping_id'],
            "note" => $requestArray['note'],
        ];

        foreach ($shoppingItems as $shoppingItem) {
            $flag = [
                'product_id' => $shoppingItem['product_id'],
                'item_id' => $shoppingItem['item_id'],
                'quantity' => $shoppingItem['quantity'],
                'price' => $shoppingItem['price'],
            ];

            $sumPrice += $shoppingItem['price'] * $shoppingItem['quantity'];
            $qty += 1;
            array_push($dataOrderItem, $flag);
        }

        if (isset($requestArray['shopping_item_id'])) {
            $dataOrderDetail["quantity_total"] = $qty;
            $dataOrderDetail["price_total"] = $sumPrice;
        } else {
            $dataOrderDetail["quantity_total"] = $shoppingSession->quantity_total;
            $dataOrderDetail["price_total"] = $shoppingSession->price_total;
        }

        DB::beginTransaction();
        try {
            $orderDetail = $this->model->create($dataOrderDetail);

            if ($orderDetail->price_total == 0 && $orderDetail->quantity_total == 0) {
                $orderDetail->delete();
                return false;
            }

            $orderDetail->orderItem()->createMany($dataOrderItem);

            if (isset($requestArray['shopping_item_id'])) {
                $this->shoppingItem->deleteDataById($requestArray['shopping_item_id']);
                $shoppingSession->update([
                    'quantity_total' => $shoppingSession->quantity_total - $dataOrderDetail["quantity_total"],
                    'price_total' => $shoppingSession->price_total - $dataOrderDetail["price_total"],
                ]);
            }else {
                $this->shoppingSession->deleteById($requestArray['shopping_session_id']);
            }
            $this->notification->createNotification([
                'user_id' => $orderDetail->user_id,
                'noti_type' => NotiTypeEnum::ORDER->value,
                'content' => StatusOrder::ORDER_WRATING->getTextNoti($orderDetail->uuid),
            ]);

            DB::commit();
            Mail::to(env('EMAIL_ADMIN'))->queue(new NewOrderMail(['uuid' => $orderDetail->uuid]));
            return $orderDetail;
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

    public function updateStatusOrder($request)
    {
        DB::beginTransaction();
        try {
            $orderDetail = $this->where('id', $request->id)->first();

            $dataUpsert = $this->getDataUpdateQuantityProductPrice($orderDetail);

            if (!$dataUpsert) {
                return [false, 'Các sản phẩm order không đủ điều kiện, vui lòng xem lại'];
            }

            if (isset($request->status_shipping) && $request->status_shipping == StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value) {
                $this->productSmartphonePrice->upsertData($dataUpsert, ['id']);
            }

            $orderDetail->update($request->all());

            DB::commit();
            return [true, ''];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return [false, __('Cập nhật đơn hàng thất bại!')];
    }

    public function cancelOrder($request)
    {
        DB::beginTransaction();
        try {
            $orderDetail = $this->where('id', $request->id)->first();
            if ($orderDetail->status_shipping == StatusShippingOrder::ORDER_SHIP_WRATING->value) {
                $orderDetail->update($request->all());
            } else {
                return false;
            }

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function getDataUpdateQuantityProductPrice($orderDetail)
    {
        $idQuantityOrderItem = $orderDetail->orderItem->pluck('quantity', 'item_id')->toArray();
        $itemIds = array_keys($idQuantityOrderItem);
        $itemProductPrices = $this->productSmartphonePrice->whereIn('id', $itemIds)->get();
        $itemProductPricesQtyArray = $itemProductPrices->pluck('quantity', 'id')->toArray();
        $itemProductPricesArray = $itemProductPrices->toArray();
        $dataUpate = [];

        foreach ($itemProductPricesArray as $key => $itemProductPrice) {
            if ($itemProductPrice['quantity'] > 0) {
                $itemProductPrice['quantity'] = $itemProductPricesQtyArray[$itemProductPrice['id']] - $idQuantityOrderItem[$itemProductPrice['id']];

                if ($itemProductPrice['quantity'] < 0) {
                    return false;
                }

                if ($itemProductPrice['quantity'] == 0) {
                    $itemProductPrice['status'] = StatusEnum::STOP_SELLING->value;
                }

                unset($itemProductPrice['created_at']);
                unset($itemProductPrice['updated_at']);
                array_push($dataUpate, $itemProductPrice);
            } else {
                return false;
            }
        }

        return $dataUpate;
    }

    public function search($params)
    {
        return $this->model->with('user')
            ->where(function ($q) use ($params) {
                $q->when(isset($params['key_search']), function ($q) use ($params) {
                    $q->where('uuid', 'like', '%' . $params['key_search'] . '%');
                });
            })->orWhereHas('user', function($q) use($params) {
                $q->when(isset($params['key_search']), function($q) use($params) {
                    $q->where('users.email', 'like', '%'. $params['key_search'] . '%')
                        ->orWhere('users.phone', 'like', '%'. $params['key_search'] . '%');
                });
            })
            ->when(isset($params['user']), function($q) use($params) {
                $q->where('user_id', $params['user']);
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
            ->paginate(10);
    }
}

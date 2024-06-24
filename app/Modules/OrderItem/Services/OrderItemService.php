<?php

namespace App\Modules\OrderItem\Services;

use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use App\Modules\OrderItem\Models\OrderItem;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

/**
 * @OrderItemService
 */
class OrderItemService extends BaseService implements OrderItemInterface
{
    protected $media;

    /**
     * @param OrderItem $orderitem
     */
    public function __construct(OrderItem $orderitem)
    {
        $this->model = $orderitem;
    }

    public function getOrderItemByOrderDetailId($orderDetailId, $perPage = null, $page = null)
    {
        return $this->model->with([
            'product',
            'productPrice.ram',
            'productPrice.storageCapacity',
            'productPrice.color',
        ])->where('order_detail_id', $orderDetailId)
            ->groupBy('id')
            ->select('order_items.*', DB::raw('order_items.quantity * SUM(price) as total_price_item'))
            ->paginate($perPage, page: $page);
    }

}

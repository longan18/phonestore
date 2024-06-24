<?php

namespace App\Modules\OrderDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use App\Modules\OrderDetail\Models\OrderDetail;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use Illuminate\Http\Request;

/**
 * @OrderDetailController
 */
class OrderDetailController extends Controller
{
    protected $orderdetail;
    protected $orderItem;

    /**
     * @param OrderDetailInterface $orderdetail
     * @param OrderItemInterface $orderItem
     */
    public function __construct(
        OrderDetailInterface $orderdetail,
        OrderItemInterface $orderItem
    ) {
        $this->orderdetail = $orderdetail;
        $this->orderItem = $orderItem;
    }

    public function index()
    {
        $orderDetails = $this->orderdetail->getOrderDetailByUserId(userInfo()->id, perPage: 5);

        return view('client.order.index', compact('orderDetails'));
    }

    public function store(Request $request)
    {
        $result = $this->orderdetail->storeOrder($request->all());

        return $result ? $this->responseSuccess(message: __('Đơn hàng của bạn đã được tạo, vui lòng chờ xác nhận của cửa hàng!'))
                    : $this->responseFailed(message: __('Đã có lỗi xảy ra, vui lòng thử lại trong vài phút'));
    }

    public function show(OrderDetail $order)
    {
        $orderItems = $this->orderItem->getOrderItemByOrderDetailId($order->id, perPage: 10);
        return view('client.order.show', compact('orderItems'));
    }
}

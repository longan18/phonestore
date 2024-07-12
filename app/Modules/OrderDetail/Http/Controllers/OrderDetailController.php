<?php

namespace App\Modules\OrderDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Payment\Http\VnPay;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use App\Modules\OrderDetail\Models\OrderDetail;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use Illuminate\Http\Request;

/**
 * @OrderDetailController
 */
class OrderDetailController extends Controller
{
    protected $orderDetail;
    protected $orderItem;
    protected $vnPay;

    /**
     * @param OrderDetailInterface $orderdetail
     * @param OrderItemInterface $orderItem
     * @param VnPay $vnPay
     */
    public function __construct(
        OrderDetailInterface $orderDetail,
        OrderItemInterface $orderItem,
        VnPay $vnPay
    ) {
        $this->orderDetail = $orderDetail;
        $this->orderItem = $orderItem;
        $this->vnPay = $vnPay;
    }

    public function index(Request $request)
    {
        $orderDetails = $this->orderDetail->getOrderDetailByUserId(userInfo()->id, perPage: 5);

        return view('client.order.index', compact('orderDetails'));
    }

    public function store(Request $request)
    {
        $orderDetail = $this->orderDetail->storeOrder($request->all());

        if ($orderDetail && $request->payment == 'vn_pay') {
            $response = $this->vnPay->payment($orderDetail);
            if ($response['code'] == 00) {
                return $this->responseSuccess(message: __('Đơn hàng của bạn đã được tạo, vui lòng chờ xác nhận của cửa hàng!'),
                data: $response['url']);
            }
        }

        return $orderDetail ? $this->responseSuccess(message: __('Đơn hàng của bạn đã được tạo, vui lòng chờ xác nhận của cửa hàng!'))
                    : $this->responseFailed(message: __('Đã có lỗi xảy ra, vui lòng thử lại trong vài phút'));
    }

    public function show(OrderDetail $order)
    {
        $orderItems = $this->orderItem->getOrderItemByOrderDetailId($order->id, perPage: 10);
        return view('client.order.show', compact('orderItems'));
    }

    public function cancelOrder(Request $request)
    {
        $result = $this->orderDetail->cancelOrder($request);

        return $result ? $this->responseSuccess(message: __('Hủy đơn hàng thành công!'))
            : $this->responseFailed(message: __('Hủy đơn hàng thất bại!'));
    }
}

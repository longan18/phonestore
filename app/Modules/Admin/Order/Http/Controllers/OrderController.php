<?php

namespace App\Modules\Admin\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use App\Modules\OrderDetail\Models\OrderDetail;
use App\Modules\OrderItem\Interfaces\OrderItemInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderDetail;
    protected $orderItem;

    /**
     * @param OrderDetailInterface $orderDetail
     * @param OrderItemInterface $orderItem
     */
    public function __construct(
        OrderDetailInterface $orderDetail,
        OrderItemInterface $orderItem
    ){
        $this->orderDetail = $orderDetail;
        $this->orderItem = $orderItem;
    }

    public function index(Request $request)
    {
        $orderDetails = $this->orderDetail->search($request->all());

        if ($request->ajax()) {
            $view = view('admin.order.table', compact('orderDetails'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $orderDetails])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.order.index', compact('orderDetails'));
    }

//    public function getOrderByUser(User $user)
//    {
//        $orderDetails = $this->orderDetail->getOrderDetailByUserId($user->id, perPage: 10);
//        return view('admin.order.index', compact('orderDetails', 'user'));
//    }

    public function show(OrderDetail $order)
    {
        $orderItems = $this->orderItem->getOrderItemByOrderDetailId($order->id, perPage: 10);
        return view('admin.order.show', compact('orderItems'));
    }

    public function updateStatus(Request $request)
    {
        [$result, $msg] = $this->orderDetail->updateStatusOrder($request);

        return $result ? $this->responseSuccess(message: __('Cập nhật đơn hàng thành công!'))
            : $this->responseFailed(message: $msg);
    }
}

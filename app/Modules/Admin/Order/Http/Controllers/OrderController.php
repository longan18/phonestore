<?php

namespace App\Modules\Admin\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;

class OrderController extends Controller
{
    protected $orderDetail;

    /**
     * @param OrderDetailInterface $orderDetail
     */
    public function __construct(
        OrderDetailInterface $orderDetail
    ){
        $this->orderDetail = $orderDetail;
    }

    public function index()
    {
        $orderDetails = $this->orderDetail->paginate(10);
        return view('admin.order.index', compact('orderDetails'));
    }

    public function getOrderByUser(User $user)
    {
        $orderDetails = $this->orderDetail->getOrderDetailByUserId($user->id, perPage: 10);
        return view('admin.order.index', compact('orderDetails', 'user'));
    }
}

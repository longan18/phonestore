<?php

namespace App\Modules\Admin\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use Illuminate\Http\Request;

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

    public function getOrderByUser(User $user)
    {
        $orderDetails = $this->orderDetail->getOrderDetailByUserId($user->id, perPage: 10);
        return view('admin.order.index', compact('orderDetails', 'user'));
    }
}

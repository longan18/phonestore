<?php

namespace App\Modules\Admin\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Http\Requests\AccountRegisterRequest;
use App\Modules\Client\Account\Http\Requests\AccountUpdateRequest;
use App\Modules\Client\Account\Interfaces\AccountUserInterface;
use App\Modules\Client\Account\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Customer\Http\Requests\CustomerRequest;
use App\Modules\Admin\Customer\Interfaces\CustomerInterface;
use App\Modules\Admin\Customer\Models\Customer;

/**
 * @CustomerController
 */
class CustomerController extends Controller
{
    protected $customer;
    protected $accountUser;

    /**
     * @param CustomerInterface $customer
     */
    public function __construct(
        CustomerInterface $customer,
        AccountUserInterface $accountUser
    ) {
        $this->customer = $customer;
        $this->accountUser = $accountUser;
    }

    public function index(Request $request)
    {
        $users = $this->accountUser->search($request);
        if ($request->ajax()) {
            $view = view('admin.customer.table', compact('users'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $users])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.customer.index', compact('users'));
    }

    public function create()
    {
        return view('admin.customer.form');
    }

    public function store(AccountRegisterRequest $request)
    {
        $result = $this->accountUser->handle($request);
        return $result ? $this->responseSuccess(message: 'Tạo mới người dùng thành công!')
            : $this->responseFailed(message: 'Tạo mới người dùng thất bại!');
    }

    public function update(Update $request)
    {
        $result = $this->accountUser->handle($request);
        return $result ? $this->responseSuccess(message: 'Cập nhật người dùng thành công!')
            : $this->responseFailed(message: 'Cập nhật người dùng thất bại!');
    }

    public function showInfor(User $user)
    {
        return view('admin.customer.form', compact('user'));
    }
}

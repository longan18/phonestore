<?php

namespace App\Modules\Admin\Address\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\Client\Account\Services\AccountUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Address\Http\Requests\AddressRequest;
use App\Modules\Admin\Address\Models\Address;
use App\Modules\Client\Address\Interfaces\AddressInterface;

/**
 * @AddressController
 */
class AddressController extends Controller
{
    protected $address;
    protected $accountUserService;

    /**
     * @param AddressInterface $address
     * @param AddressInterface $accountUserService
     */
    public function __construct(
        AddressInterface $address,
        AccountUserService $accountUserService
    ) {
        $this->address = $address;
        $this->accountUserService = $accountUserService;
    }


    public function index(User $user)
    {
        $address = $this->accountUserService->getAddressByUser($user->id)->addressShippings;
        return view('admin.address.index', compact('address', 'user'));
    }
}

<?php

namespace App\Modules\Address\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Address\Enums\AddressShippingEnum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Address\Http\Requests\AddressRequest;
use App\Modules\Address\Interfaces\AddressInterface;
use App\Modules\Address\Models\Address;
use Illuminate\Support\Facades\DB;

/**
 * @AddressController
 */
class AddressController extends Controller
{
    protected $address;

    /**
     * @param AddressInterface $address
     */
    public function __construct(AddressInterface $address)
    {
        $this->address = $address;
    }

    public function index()
    {
        [$provinces, $districts, $wards, $addressShipping] = $this->address->getAddressDefault();

        return view('client.address.index',
            compact('provinces',
                'districts',
                'wards',
                'addressShipping'
            )
        );
    }

    public function getDistrictByProvince(Request $request)
    {
        [$districts, $wards] = $this->address->getDistrictByProvince($request);

        return $this->responseSuccess(
            data: [
                'districts' => $districts,
                'wards' => $wards,
            ]
        );
    }

    public function getWardByDistrict(Request $request)
    {
        $wards = $this->address->getWardByDistrict($request);

        return $this->responseSuccess(
            data: [
                'wards' => $wards,
            ]
        );
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'address_detail' => 'bail|required',
        ], [
            'address_detail.required' => 'Địa chỉ chi tiết không được để trống',
        ]);

        $address = $this->address->storeAddress($request);

        if ($address) {
            $view = view('components.item-address')->with([
                'province' => $address->province->name,
                'district' => $address->district->name,
                'ward' => $address->ward->name,
                'act' => AddressShippingEnum::IN_ACTIVE,
                'addresDetail' => $address->address_detail,
                'id' => $address->id,
            ])->render();
            return $this->responseSuccess(
                message: __('Thêm địa chỉ thành công!'),
                data: [
                    'address' => $address,
                    'html' => $view
                ]
            );
        }

        return $this->responseFailed(message: __('Thêm địa chỉ thất bại!'));
    }

    public function removeAddress(Request $request)
    {
        $result = $this->address->deleteAddressShipping($request->id);

        return $result ?  $this->responseSuccess(message: __('Xóa địa chỉ thành công!'))
            : $this->responseFailed(message: __('Xóa địa chỉ thất bại, vui lòng thử lại trong giây lát!'));
    }

    public function activeAddress(Request $request)
    {
        $result = $this->address->actAddressShipping($request->id);

        return $result ? $this->responseSuccess(message: __('Cập nhật địa chỉ giao hàng thành công!'))
            : $this->responseFailed(message: __('Cập nhật địa chỉ giao hàng thất bại, vui lòng thử lại trong giây lát!'));
    }
}

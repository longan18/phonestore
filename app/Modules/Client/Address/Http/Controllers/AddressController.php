<?php

namespace App\Modules\Client\Address\Http\Controllers;

use App\Enums\AddressShippingEnum;
use App\Http\Controllers\Controller;
use App\Modules\Client\Address\Interfaces\AddressInterface;
use Illuminate\Http\Request;

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

        $addressShipping = $this->address->storeAddress($request);

        if ($addressShipping) {
            $view = view('components.item-address')->with([
                'province' => $addressShipping->address->province->name,
                'district' => $addressShipping->address->district->name,
                'ward' => $addressShipping->address->ward->name,
                'act' => AddressShippingEnum::IN_ACTIVE->value,
                'addresDetail' => $addressShipping->address->address_detail,
                'id' => $addressShipping->id,
            ])->render();
            return $this->responseSuccess(
                message: __('Thêm địa chỉ thành công!'),
                data: [
                    'address' => $addressShipping->address,
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

<?php

namespace App\Modules\Client\Address\Services;

use App\Modules\Client\Account\Interfaces\AccountUserInterface;
use App\Modules\Client\Address\Interfaces\AddressInterface;
use App\Modules\Client\Address\Interfaces\AddressShippingInterface;
use App\Modules\Client\Address\Models\Address;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @AddressService
 */
class AddressService extends BaseService implements AddressInterface
{
    protected $accountUser;
    protected $addressShipping;


    public function __construct(
        Address $address,
        AccountUserInterface $accountUser,
        AddressShippingInterface $addressShipping
    ) {
        $this->model = $address;
        $this->accountUser = $accountUser;
        $this->addressShipping = $addressShipping;
    }

    public function getAddressDefault()
    {
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->where('province_id', 1)->get();
        $wards = DB::table('wards')->where('district_id', 1)->get();
        $addressShipping = optional($this->accountUser->getAddressByUser(userInfo()->id))->addressShippings ?? null;

        return [$provinces, $districts, $wards, $addressShipping];
    }

    public function getDistrictByProvince($request)
    {
        $districts = DB::table('districts')->where('province_id', $request->id)->get();
        $wards = DB::table('wards')->where('district_id', $districts->first()->id)->get();

        return [$districts, $wards];
    }

    public function getWardByDistrict($request)
    {
        return DB::table('wards')->where('district_id', $request->id)->get();
    }

    public function storeAddress($request)
    {
        if (userInfo()->count_address >= 5) {
            return false;
        }

        DB::beginTransaction();
        try {
            $address = $this->model->create($request->all());
            $addressShipping = $address->addressShippings()->create(['user_id' => userInfo()->id]);

            DB::commit();
            return $addressShipping;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function deleteAddressShipping($id)
    {
        return $this->addressShipping->deleteById($id);
    }

    public function actAddressShipping($id)
    {
        return $this->addressShipping->actAddressShipping($id);
    }
}

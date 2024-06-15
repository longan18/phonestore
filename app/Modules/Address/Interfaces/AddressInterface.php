<?php

namespace App\Modules\Address\Interfaces;

/**
 * @AddressInterface
 */
interface AddressInterface
{
    public function getAddressDefault();
    public function getDistrictByProvince($request);
    public function getWardByDistrict($request);

    public function storeAddress($request);
    public function deleteAddressShipping($id);

    public function actAddressShipping($id);
}

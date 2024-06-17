<?php

namespace App\Modules\Client\Address\Interfaces;

interface AddressShippingInterface
{
    public function deleteById($id);

    public function getAddressActByUserId($id);

    public function actAddressShipping($id);
}

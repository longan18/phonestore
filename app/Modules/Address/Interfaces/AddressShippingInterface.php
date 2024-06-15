<?php

namespace App\Modules\Address\Interfaces;

interface AddressShippingInterface
{
    public function deleteById($id);

    public function getAddressActByUserId($id);

    public function actAddressShipping($id);
}

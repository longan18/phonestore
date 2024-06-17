<?php

namespace App\Modules\Client\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\Client\Address\Interfaces\AddressShippingInterface;
use App\Modules\Client\Profile\Interfaces\ProfileInterface;

/**
 * @ProfileController
 */
class ProfileController extends Controller
{
    protected $profile;
    protected $addressShipping;

    /**
     * @param ProfileInterface $profile
     * @param AddressShippingInterface $addressShipping
     */
    public function __construct(
        ProfileInterface $profile,
        AddressShippingInterface $addressShipping
    ) {
        $this->profile = $profile;
        $this->addressShipping = $addressShipping;
    }

    public function show(User $user)
    {
        $addressAct = $this->addressShipping->getAddressActByUserId($user->id);
        return view('client.infor.profile', compact('user', 'addressAct'));
    }
}

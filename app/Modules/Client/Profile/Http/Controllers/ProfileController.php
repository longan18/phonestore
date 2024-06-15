<?php

namespace App\Modules\Client\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Address\Interfaces\AddressShippingInterface;
use App\Modules\Client\Account\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Client\Profile\Http\Requests\ProfileRequest;
use App\Modules\Client\Profile\Interfaces\ProfileInterface;
use App\Modules\Client\Profile\Models\Profile;

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

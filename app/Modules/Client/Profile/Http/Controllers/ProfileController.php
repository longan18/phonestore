<?php

namespace App\Modules\Client\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
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

    /**
     * @param ProfileInterface $profile
     */
    public function __construct(ProfileInterface $profile)
    {
        $this->profile = $profile;
    }

    public function show(User $user)
    {
        return view('client.infor.profile', compact('user'));
    }
}

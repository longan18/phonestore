<?php

namespace App\Modules\Admin\Account\Interfaces;
use Illuminate\Http\Request;

/**
 * Interface AccountAdminInterface
 *
 * @package App\Modules\Admin\Account\Interfaces
 */
interface AccountAdminInterface
{
    /**
     * @param Request $request
     */
    public function login(Request $request);

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request);


    /**
     * @param Request $request
     */
    public function updatePassword(Request $request);
}

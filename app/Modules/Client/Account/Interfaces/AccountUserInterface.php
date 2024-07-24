<?php

namespace App\Modules\Client\Account\Interfaces;

/**
 * @AccountInterface
 */
interface AccountUserInterface
{
    public function search($request);
    public function handle($request);
    public function login($request);
    public function logout();
    public function getAddressByUser($id);
    public function forgotPassword($request);
}

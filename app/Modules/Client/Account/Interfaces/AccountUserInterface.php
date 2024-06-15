<?php

namespace App\Modules\Client\Account\Interfaces;

/**
 * @AccountInterface
 */
interface AccountUserInterface
{
    public function handle($request);
    public function login($request);
    public function getAddressByUser($id);
}

<?php

namespace App\Modules\ShoppingSession\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use App\Modules\ShoppingSession\Models\ShoppingSession;
use App\Services\BaseService;

/**
 * @ShoppingSessionService
 */
class ShoppingSessionService extends BaseService implements ShoppingSessionInterface
{
    /**
     * @param ShoppingSession $shoppingsession
     */
    public function __construct(ShoppingSession $shoppingsession)
    {
        $this->model = $shoppingsession;
    }
}

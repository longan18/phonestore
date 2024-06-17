<?php

namespace App\Modules\Admin\Address\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Address\Interfaces\AddressInterface;
use App\Modules\Admin\Address\Models\Address;
use App\Services\BaseService;

/**
 * @AddressService
 */
class AddressService extends BaseService implements AddressInterface
{
    protected $media;

    /**
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->model = $address;
    }
}

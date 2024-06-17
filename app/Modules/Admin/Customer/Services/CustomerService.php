<?php

namespace App\Modules\Admin\Customer\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Customer\Interfaces\CustomerInterface;
use App\Modules\Admin\Customer\Models\Customer;
use App\Services\BaseService;

/**
 * @CustomerService
 */
class CustomerService extends BaseService implements CustomerInterface
{
    protected $media;

    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }
}

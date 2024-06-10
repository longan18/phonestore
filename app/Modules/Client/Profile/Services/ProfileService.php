<?php

namespace App\Modules\Client\Profile\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Client\Profile\Interfaces\ProfileInterface;
use App\Modules\Client\Profile\Models\Profile;
use App\Services\BaseService;

/**
 * @ProfileService
 */
class ProfileService extends BaseService implements ProfileInterface
{
    protected $media;

    /**
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        $this->model = $profile;
    }
}

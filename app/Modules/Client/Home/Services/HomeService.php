<?php

namespace App\Modules\Client\Home\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Client\Home\Interfaces\HomeInterface;
use App\Modules\Client\Home\Models\Home;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @HomeService
 */
class HomeService extends BaseService implements HomeInterface
{
    protected $media;

    /**
     * @param Home $home
     * @param MediaInterface $media
     */
    public function __construct(Home $home, MediaInterface $media)
    {
        $this->model = $home;
        $this->media = $media;
    }
}

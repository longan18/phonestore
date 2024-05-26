<?php

namespace App\Modules\Admin\Ram\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Ram\Interfaces\RamInterface;
use App\Modules\Admin\Ram\Models\Ram;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @RamService
 */
class RamService extends BaseService implements RamInterface
{
    protected $media;

    /**
     * @param Ram $ram
     * @param MediaInterface $media
     */
    public function __construct(Ram $ram, MediaInterface $media)
    {
        $this->model = $ram;
        $this->media = $media;
    }
}

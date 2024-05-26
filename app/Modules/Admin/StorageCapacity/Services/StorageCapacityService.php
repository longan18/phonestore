<?php

namespace App\Modules\Admin\StorageCapacity\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\StorageCapacity\Interfaces\StorageCapacityInterface;
use App\Modules\Admin\StorageCapacity\Models\StorageCapacity;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @StorageCapacityService
 */
class StorageCapacityService extends BaseService implements StorageCapacityInterface
{
    protected $media;

    /**
     * @param StorageCapacity $storagecapacity
     * @param MediaInterface $media
     */
    public function __construct(StorageCapacity $storagecapacity, MediaInterface $media)
    {
        $this->model = $storagecapacity;
        $this->media = $media;
    }
}

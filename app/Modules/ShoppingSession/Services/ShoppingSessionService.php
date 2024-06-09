<?php

namespace App\Modules\ShoppingSession\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use App\Modules\ShoppingSession\Models\ShoppingSession;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ShoppingSessionService
 */
class ShoppingSessionService extends BaseService implements ShoppingSessionInterface
{
    protected $media;

    /**
     * @param ShoppingSession $shoppingsession
     * @param MediaInterface $media
     */
    public function __construct(ShoppingSession $shoppingsession, MediaInterface $media)
    {
        $this->model = $shoppingsession;
        $this->media = $media;
    }
}

<?php

namespace App\Modules\Admin\Color\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Color\Interfaces\ColorInterface;
use App\Modules\Admin\Color\Models\Color;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ColorService
 */
class ColorService extends BaseService implements ColorInterface
{
    protected $media;

    /**
     * @param Color $color
     * @param MediaInterface $media
     */
    public function __construct(Color $color, MediaInterface $media)
    {
        $this->model = $color;
        $this->media = $media;
    }
}

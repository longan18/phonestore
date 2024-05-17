<?php

namespace App\Modules\Admin\Category\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Category\Models\Category;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @CategoryService
 */
class CategoryService extends BaseService implements CategoryInterface
{
    protected $media;

    /**
     * @param Category $category
     * @param MediaInterface $media
     */
    public function __construct(Category $category, MediaInterface $media)
    {
        $this->model = $category;
        $this->media = $media;
    }
}

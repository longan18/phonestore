<?php

namespace App\Modules\Admin\Brand\Services;

use App\Enums\TagMediaEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @BrandService
 */
class BrandService extends BaseService implements BrandInterface
{
    protected $media;

    /**
     * @param Brand $brand
     * @param MediaInterface $media
     */
    public function __construct(Brand $brand, MediaInterface $media)
    {
        $this->model = $brand;
        $this->media = $media;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handleBrand(Request $request): bool
    {
        if ($request->id) {
            $handle = $this->getById($request->id);
            $handle->update($request->only('name'));
        } else {
            $handle = $this->create($request->only('name'));
        }

        return $this->media->uploadAvatar($handle, $request, 'brand');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model::search($request)->paginate(PAGE_RECORD);
    }

    /**
     * @return mixed
     */
    public function getPublish(): mixed
    {
        return $this->model::getPublish()->get();
    }

    /**
     * @param $brand
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete($brand): ?bool
    {
        $brand = $this->getById($brand);
        $this->media->deleteExistingFile($brand->getMedia(TagMediaEnum::Avatar->value)->first());
        return $brand->delete();
    }
}

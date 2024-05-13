<?php

namespace App\Modules\Admin\Brand\Services;

use App\Enums\TagMedia;
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
        return $this->uploadAvatar($handle, $request, $handle);
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
        $this->media->deleteExistingFile($brand->getMedia(TagMedia::Avatar->value)->first());
        return $brand->delete();
    }

    /**
     * @param $update
     * @param $request
     * @param $model
     *
     * @return bool
     */
    private function uploadAvatar($update, $request, $model): bool
    {
        if ($update) {
            if ($request->hasFile('avatar')) {
                $media = $this->media->upload($request->file('avatar'), directory: 'brand');
            }
            if (!empty($media) && $model->hasMedia(TagMedia::Avatar->value)) {
                $this->media->deleteExistingFile($model->getMedia(TagMedia::Avatar->value)->first());
            }
            empty($media) ?: $model->syncMedia($media, TagMedia::Avatar->value);

            return true;
        }

        return false;
    }
}

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
     * @param $request
     * @return mixed
     */
    public function handleBrand($request)
    {
        if ($request->id) {
            $brand = $this->getById($request->id);
            $brand->update($request->only('name'));
        } else {
            $brand = $this->create($request->only('name'));
        }

        return $this->media->uploadAvatar(
            $brand,
            $request,
            'thumb_avatar_brand',
            TagMediaEnum::THUMB_AVATAR_BRAND->getDirectory(),
            TagMediaEnum::THUMB_AVATAR_BRAND->value
        );
    }

    /**
     * @param $request
     * @return mixed
     */
    public function search($request)
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
        $this->media->deleteExistingFile($brand->getMedia(TagMediaEnum::THUMB_AVATAR_BRAND->value)->first());
        return $brand->delete();
    }

    public function updateStatusBrand($model, $request)
    {
        DB::beginTransaction();
        try {
            $this->updateStatus($model, $request);

            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

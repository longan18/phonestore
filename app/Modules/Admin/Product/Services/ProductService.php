<?php

namespace App\Modules\Admin\Product\Services;

use App\Enums\StatusEnum;
use App\Enums\TagMediaEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ProductService
 */
class ProductService extends BaseService implements ProductInterface
{
    protected $media;

    /**
     * @param Product $product
     * @param MediaInterface $mediaInterface
     */
    public function __construct(Product $product, MediaInterface $media)
    {
        $this->model = $product;
        $this->media = $media;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search($request): mixed
    {
        return $this->model::search($request)->paginate(PAGE_RECORD);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createOrUpdate($request)
    {
        $arrData = $request->only($this->fillable());

        if (empty($request->slug)) {
            $arrData['slug'] = uuid();
        }

        DB::beginTransaction();
        try {
            $product = $this->model::upsertWithReturn($arrData, ['slug'],
                [
                    'name',
                    'brand_id',
                    'category_id',
                ],
            );

            $this->media->uploadAvatar(
                $product,
                $request,
                'thumb_avatar_product',
                TagMediaEnum::THUMB_AVATAR_PRODUCT->getDirectory(),
                TagMediaEnum::THUMB_AVATAR_PRODUCT->value
            );

            $this->media->uploadSubImage(
                $product,
                $request,
                TagMediaEnum::SUB_IMAGE_PRODUCT->getDirectory(),
                TagMediaEnum::SUB_IMAGE_PRODUCT->value
            );

            DB::commit();
            return $product;
        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return $this->deleteById($id);
    }

    public function getDataPageHome()
    {
        return $this->model->where('status', StatusEnum::PUBLISH->value)
            ->with($this->withDataProduct())
            ->get();
    }

    public function getProductBySlug($slug)
    {
        return $this->model->where('slug', $slug)
            ->with($this->withDataProduct())
            ->first();
    }

    private function withDataProduct()
    {
        return [
            'productSmartphonePrice.media',
            'productSmartphone',
            'productSmartphonePrice' => function ($query) {
                $query->where('status', StatusEnum::PUBLISH->value);
            },
            'productSmartphonePrice.ram',
            'productSmartphonePrice.storageCapacity',
            'productSmartphonePrice.color'
        ];
    }

    public function updateStatusProduct($model, $request)
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

    public function updateStatusByBrandId($brandId, $status)
    {
        return $this->model->where('brand_id', $brandId)->update(['status' => $status]);
    }
}

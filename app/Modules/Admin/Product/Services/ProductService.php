<?php

namespace App\Modules\Admin\Product\Services;

use App\Enums\TagMedia;
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
    protected $mediaInterface;

    /**
     * @param Product $product
     * @param MediaInterface $mediaInterface
     */
    public function __construct(Product $product, MediaInterface $mediaInterface)
    {
        $this->model = $product;
        $this->mediaInterface = $mediaInterface;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search($request, $categoryId): mixed
    {
        return $this->model::search($request, $categoryId)->paginate(PAGE_RECORD);
    }

    /**
     * @param $request
     * @return Model
     */
    public function store($request)
    {
        $arrData = $this->getDataFillable($request, true);
        return $this->create($arrData);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataFillable($request, $create = false)
    {
        $arrData = $request->only($this->model->getFillable());
        if ($create) {
            $arrData['slug'] = uuid();
        }

        return $arrData;
    }

    /**
     * @param $model
     * @param $request
     * @return void
     */
    public function uploadAvatar($model, $request)
    {
        if ($model) {
            if ($request->hasFile('avatar')) {
                $media = $this->mediaInterface->upload($request->file('avatar'), directory: 'product');
            }
            if (!empty($media) && $model->hasMedia(TagMedia::Avatar->value)) {
                $this->mediaInterface->deleteExistingFile($model->getMedia(TagMedia::Avatar->value)->first());
            }
            empty($media) ?: $model->syncMedia($media, TagMedia::Avatar->value);
        }
    }


}

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
        $product = $this->create($arrData);

        $this->media->uploadAvatar($product, $request);
        $this->media->uploadSubImage($product, $request);

        return $product;
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
}

<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ProductSmartphonePriceService
 */
class ProductSmartphonePriceService extends BaseService implements ProductSmartphonePriceInterface
{
    protected $media;

    /**
     * @param ProductSmartphonePrice $productsmartphoneprice
     * @param MediaInterface $media
     */
    public function __construct(ProductSmartphonePrice $productsmartphoneprice, MediaInterface $media)
    {
        $this->model = $productsmartphoneprice;
        $this->media = $media;
    }


    public function handle($request)
    {
        DB::beginTransaction();
        try {
           $dataArr = $request->only($this->model->getFillable());
           $dataArr['price'] = str_replace(',', '', $dataArr['price']);
           $dataArr['id'] = $request->id ?? null;

           $model = $this->model::upsertWithReturn($dataArr, ['id', 'item_id'], $this->model->getFillable());
           $this->media->uploadAvatar($model, $request);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

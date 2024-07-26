<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Services;

use App\Enums\StatusEnum;
use App\Enums\TagMediaEnum;
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

    /**
     * @param $request
     * @return bool
     */
    public function handle($request)
    {
        DB::beginTransaction();
        try {
           $dataArr = $request->only($this->model->getFillable());
           $dataArr['price'] = str_replace(',', '', $dataArr['price']);
           $dataArr['id'] = $request->id ?? null;
           $dataArr['status'] = $request->status ?? \App\Enums\StatusEnum::STOP_SELLING->value;

           $model = $this->model::upsertWithReturn($dataArr, ['id', 'product_id'], $this->model->getFillable());
            $this->media->uploadAvatar(
                $model,
                $request,
                'thumb_avatar_option',
                TagMediaEnum::THUMB_AVATAR_OPTION->getDirectory(),
                TagMediaEnum::THUMB_AVATAR_OPTION->value
            );
//            $this->media->uploadAvatar(
//                $model,
//                $request,
//                'thumb_option',
//                TagMediaEnum::THUMB_OPTION->getDirectory(),
//                TagMediaEnum::THUMB_OPTION->value
//            );

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function getByProductId($itemId)
    {
        return $this->with(['ram', 'color', 'storageCapacity'])
            ->where('product_id', $itemId)
            ->get();
    }

    public function getOptionProduct($productSmartphonePrice)
    {
        if ($productSmartphonePrice->count() == 0) {
            return abort(404);
        }

        foreach($productSmartphonePrice as $key => $item) {
            $data_result['data'][$item->ram_id . '-' . $item->storage_capacity_id][] = [
                'item_id' => $item->id,
                'price' => $item->price,
                'color_id' => $item->color_id,
                'color' => $item->color->color,
                'ram_id' => $item->ram_id,
                'ram' => $item->ram->value,
                'storage_capacity_id' => $item->storage_capacity_id,
                'storage_capacity' => $item->storageCapacity->value,
                'quantity' => $item->quantity,
                'avatar' => $item->avatar
            ];

            $data_result['key'][$item->ram_id . '-' . $item->storage_capacity_id] = [
                'title' => $item->ram->value . '-' . $item->storageCapacity->value,
                'ram' => $item->ram->value,
                'storage_capacity' => $item->storageCapacity->value,
                'remaining_capacity_is_approx' => $item->remaining_capacity_is_approx,
            ];

            if(!$key) {
                $data_result['default'] = [
                    'title' => $item->ram->value . '-' . $item->storageCapacity->value,
                    'ram' => $item->ram->value,
                    'storage_capacity' => $item->storageCapacity->value,
                    'remaining_capacity_is_approx' => $item->remaining_capacity_is_approx,
                ];
            }
        }

        return $data_result;
    }

    public function deleteOption($id)
    {
        return $this->deleteById($id);
    }

    public function countOptionPublishProduct($productId)
    {
        return $this->where('product_id', $productId)
            ->where('status', StatusEnum::PUBLISH->value)
            ->count();
    }

    public function updateStatusByProductId($productId, $status)
    {
        return $this->model->where('product_id', $productId)->update(['status' => $status]);
    }

    public function updateStatusProductPrice($model, $request)
    {
        DB::beginTransaction();
        try {
            $countOptionPublish = $this->countOptionPublishProduct($model->product_id);
            if (($request->status == StatusEnum::UNKNOWN->value || $request->status == StatusEnum::STOP_SELLING->value)
                && $countOptionPublish == 1
            ) {
                $model->product()->update(['status' => StatusEnum::STOP_SELLING->value]);
            }

            if ($model->quantity != 0) {
                $this->updateStatus($model, $request);
            }


            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

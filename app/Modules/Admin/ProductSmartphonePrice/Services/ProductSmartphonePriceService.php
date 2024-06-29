<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Services;

use App\Enums\StatusEnum;
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

           $model = $this->model::upsertWithReturn($dataArr, ['id', 'product_id'], $this->model->getFillable());
           $this->media->uploadAvatar($model, $request);

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
                'color' => $item->color->hex_color,
                'ram_id' => $item->ram_id,
                'ram' => $item->ram->value,
                'storage_capacity_id' => $item->storage_capacity_id,
                'storage_capacity' => $item->storageCapacity->value,
                'quantity' => $item->quantity
            ];

            $data_result['key'][$item->ram_id . '-' . $item->storage_capacity_id] = $item->ram->value . '-' . $item->storageCapacity->value;
        }

        $data_result['key'] = array_unique($data_result['key']);

        return $data_result;
    }

    public function deleteOption($id)
    {
        return $this->deleteById($id);
    }

    public function countOptionPublishProduct($productId)
    {
        return $this->where('product_id', $productId)
            ->where('status', StatusEnum::Publish->value)
            ->count();
    }
}

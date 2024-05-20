<?php

namespace App\Modules\Admin\ProductSmartphone\Services;

use App\Enums\TagMedia;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Admin\ProductSmartphone\Interfaces\ProductSmartphoneInterface;
use App\Modules\Admin\ProductSmartphone\Models\ProductSmartphone;
use App\Services\BaseService;

/**
 * @ProductSmartphoneService
 */
class ProductSmartphoneService extends BaseService implements ProductSmartphoneInterface
{
    protected $product;

    /**
     * @param ProductSmartphone $productsmartphone
     * @param ProductInterface $product
     */
    public function __construct(
        ProductSmartphone $productsmartphone,
        ProductInterface $product
    ) {
        $this->model = $productsmartphone;
        $this->product = $product;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function search($request): mixed
    {
        return $this->model::search($request)->paginate(PAGE_RECORD);
    }

    public function handle($request)
    {
        DB::beginTransaction();
        try {
            if (empty($request->id)) {
                $product = $this->product->store($request);
                $product->productSmartphone()->create($request->only($this->model->getFillable()));
            }

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

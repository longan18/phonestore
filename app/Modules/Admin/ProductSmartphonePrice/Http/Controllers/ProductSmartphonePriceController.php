<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\ProductSmartphonePrice\Http\Requests\ProductSmartphonePriceRequest;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Illuminate\Support\Facades\Log;

/**
 * @ProductSmartphonePriceController
 */
class ProductSmartphonePriceController extends Controller
{
    protected $productSmartphonePrice;

    public function __construct(ProductSmartphonePriceInterface $productSmartphonePrice)
    {
        $this->productSmartphonePrice = $productSmartphonePrice;
    }

    /**
     * @param Product $product
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request,Product $product)
    {
        $options = $this->productSmartphonePrice->getByProductId($product->id);

        if ($request->ajax()) {
            $view = view('admin.product-smartphone.option.table-option', compact('product', 'options'))->render();

            return $this->responseSuccess(data: ['html' => $view]);
        }

        return view('admin.product-smartphone.option.index', compact('product', 'options'));
    }

    /**
     * @param Product $product
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(Product $product)
    {
        return view('admin.product-smartphone.option.form', compact('product'));
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Product $product, Request $request)
    {
        $productSmartphonePrice = $this->productSmartphonePrice->getById($request->option);
        return view('admin.product-smartphone.option.form', compact('product', 'productSmartphonePrice'));
    }

    /**
     * @param ProductSmartphonePriceRequest $request
     * @return JsonResponse
     */
    public function store(ProductSmartphonePriceRequest $request)
    {
        try {
            $result = $this->productSmartphonePrice->handle($request);

            return $result ? $this->responseSuccess(message: __('Tạo option thành công!'))
                : $this->responseFailed(message: __('Tạo option thất bại!'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->responseFailed(message: __('Tạo option thất bại!'));
        }
    }

    /**
     * @param ProductSmartphonePriceRequest $request
     * @return JsonResponse
     */
    public function update(ProductSmartphonePriceRequest $request)
    {
        try {
            $result = $this->productSmartphonePrice->handle($request);

            return $result ? $this->responseSuccess(message: __('Cập nhật option thành công!'))
                : $this->responseFailed(message: __('Cập nhật option thất bại!'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->responseFailed(message: __('Cập nhật option thất bại!'));
        }
    }

    /**
     * @param ProductSmartphonePrice $productPrice
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus(ProductSmartphonePrice $option, Request $request)
    {
        $result = $this->productSmartphonePrice->updateStatusProductPrice($option, $request);

        return $result ? $this->responseSuccess(message: __('Cập nhật option thành công!'), data: [
            'status' => $result->status,
            'updated_at' => $result->updated_at->toDateTimeString(),
        ]) : $this->responseFailed(message: __('Cập nhật option thất bại!'));
    }

    /**
     * deleteOption
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteOption($id)
    {
        try {
            $result = $this->productSmartphonePrice->deleteOption($id);

            return $result ? $this->responseSuccess(message: __('Xóa option sản phẩm thành công!'))
                : $this->responseFailed(message: __('Xóa phẩm option thất bại!'));
        } catch (\Exception $exception) {
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");

            return $this->responseFailed(message: __('Xóa phẩm option thất bại!'));
        }
    }
}

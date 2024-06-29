<?php

namespace App\Modules\Admin\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\ProductSmartphone\Interfaces\ProductSmartphoneInterface;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Product\Http\Requests\ProductRequest;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Models\Product;
use Illuminate\Support\Facades\Log;

/**
 * @ProductController
 */
class ProductController extends Controller
{
    protected $product;
    protected $productSmartphonePrice;

    /**
     * @param ProductInterface $product
     * @param ProductSmartphonePriceInterface $productSmartphone
     */
    public function __construct(
        ProductInterface $product,
        ProductSmartphonePriceInterface $productSmartphonePrice
    ) {
        $this->product = $product;
        $this->productSmartphonePrice = $productSmartphonePrice;
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus(Product $product, Request $request)
    {
        $countOptionPublish = $this->productSmartphonePrice->countOptionPublishProduct($product->id);

        if ($countOptionPublish == 0) {
            return $this->responseFailed(message: __('Cập nhật thất bại, bắt buộc phải có một option đang được mở bán'));
        }

        try {
            $result = $this->product->updateStatus($product, $request);

            return $result ? $this->responseSuccess(message: __('Cập nhật sản phẩm thành công!'), data: $request->status)
                : $this->responseFailed(message: __('Cập nhật phẩm thất bại!'));
        } catch (\Exception $exception) {
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
            return $this->responseFailed(message: __('Cập nhật phẩm thất bại!'));
        }
    }
}

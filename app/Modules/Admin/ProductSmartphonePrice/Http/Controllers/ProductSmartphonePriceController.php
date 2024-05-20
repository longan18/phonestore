<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Http\Controllers;

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
    public function create(Product $product)
    {
        return view('admin.product-smartphone.option.form', compact('product'));
    }

    /**
     * @param Product $product
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Product $product)
    {
        $options = $product->smartphone->smartphone_price;
        return view('admin.product-smartphone.option.index', compact('product', 'options'));
    }

    public function handle(ProductSmartphonePriceRequest $request)
    {
        try {
            $this->productSmartphonePrice->handle($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thất bại!'));
        }
    }

    public function show()
    {

    }
}

<?php

namespace App\Modules\Admin\ProductSmartphone\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\ProductSmartphonePrice\Models\ProductSmartphonePrice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\ProductSmartphone\Http\Requests\ProductSmartphoneRequest;
use App\Modules\Admin\ProductSmartphone\Interfaces\ProductSmartphoneInterface;
use App\Modules\Admin\ProductSmartphone\Models\ProductSmartphone;
use Illuminate\Support\Facades\Log;

/**
 * @ProductSmartphoneController
 */
class ProductSmartphoneController extends Controller
{
    protected $productSmartphone;
    protected $product;

    /**
     * @param ProductSmartphoneInterface $productSmartphone
     * @param ProductInterface $product
     */
    public function __construct(
        ProductSmartphoneInterface $productSmartphone,
        ProductInterface $product
    ) {
        $this->productSmartphone = $productSmartphone;
        $this->product = $product;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request): Application|Factory|View|JsonResponse
    {
        $products = $this->product->search($request, CATEGORY_SAMRTPHONE);
        if ($request->ajax()) {
            $view = view('admin.product-smartphone.table', compact('products'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $products])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.product-smartphone.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.product-smartphone.form');
    }

    /**
     * @param Product $product
     *
     * @return Application|Factory|View
     */
    public function show(Product $product): View|Factory|Application
    {
        return view('admin.product-smartphone.form', compact('product'));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function handle(ProductSmartphoneRequest $request): JsonResponse
    {
        try {
            $this->productSmartphone->handle($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' sản phẩm thất bại!'));
        }
    }
}

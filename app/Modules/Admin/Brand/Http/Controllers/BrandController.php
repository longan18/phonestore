<?php

namespace App\Modules\Admin\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Brand\Http\Requests\BrandRequest;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Models\Brand;
use Illuminate\Support\Facades\Log;

/**
 * @BrandController
 */
class BrandController extends Controller
{
    protected $brandInterface;

    /**
     * @param BrandInterface $brandInterface
     */
    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandInterface = $brandInterface;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request): Application|Factory|View|JsonResponse
    {
        $brands = $this->brandInterface->search($request);
        if ($request->ajax()) {
            $view = view('admin.brand.table', compact('brands'))->render();
            $paginate = view('admin.pagination.index')->with(['data' => $brands])->render();

            return $this->responseSuccess(data: ['html' => $view, 'pagination' => $paginate]);
        }

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * @param BrandRequest $request
     *
     * @return JsonResponse
     */
    public function handle(BrandRequest $request): JsonResponse
    {
        try {
            $this->brandInterface->handleBrand($request);

            return $this->responseSuccess(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' nhãn hiệu thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());

            return $this->responseFailed(message: __((!empty($request->id) ? 'Sửa' : 'Tạo').' nhãn hiệu thất bại!'));
        }
    }

    /**
     * @param Brand $brand
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.form', compact('brand'));
    }

    public function updateStatus(Brand $brand, Request $request)
    {
        $result = $this->brandInterface->updateStatusBrand($brand, $request);

        return $result ? $this->responseSuccess(message: __('Cập nhật thương hiệu thành công!'), data: [
            'status' => $result->status,
            'updated_at' => $result->updated_at->toDateTimeString(),
        ]) : $this->responseFailed(message: __('Cập nhật thương hiệu thất bại!'));
    }
}

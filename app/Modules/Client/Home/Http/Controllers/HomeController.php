<?php

namespace App\Modules\Client\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Admin\Ram\Models\Ram;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Client\Home\Http\Requests\HomeRequest;
use App\Modules\Client\Home\Interfaces\HomeInterface;
use App\Modules\Client\Home\Models\Home;
use Illuminate\Support\Facades\DB;

/**
 * @HomeController
 */
class HomeController extends Controller
{
    protected $home;
    protected $productInterface;

    /**
     * @param HomeInterface $home
     * @param ProductInterface $productInterface
     */
    public function __construct(
        HomeInterface $home,
        ProductInterface $productInterface
    ) {
        $this->home = $home;
        $this->productInterface = $productInterface;
    }

    public function getDataPageHome(Request $request)
    {
        $products = $this->productInterface->getDataPageHome($request->all());

        return view('client.home.index', compact('products'));
    }
}

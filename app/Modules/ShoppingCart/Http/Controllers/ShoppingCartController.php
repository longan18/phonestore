<?php

namespace App\Modules\ShoppingCart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\ShoppingCart\Http\Requests\ShoppingCartRequest;
use App\Modules\ShoppingCart\Interfaces\ShoppingCartInterface;
use App\Modules\ShoppingCart\Models\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Number;

/**
 * @ShoppingCartController
 */
class ShoppingCartController extends Controller
{
    protected $shoppingcart;

    /**
     * @param
     */
    public function __construct(
        ShoppingCartInterface $shoppingCart
    ) {
        $this->shoppingcart = $shoppingCart;
    }

    public function addCart(Request $request)
    {
        $result = $this->shoppingcart->storeCart($request->all());

        return $result ? $this->responseSuccess(message: __('Sản phẩm đã được thêm vào giỏ hàng'), data: $result)
                : $this->responseFailed(message: __('Sản phẩm chưa được thêm vào giỏ hàng, vui lòng thử lại!'));
    }
}

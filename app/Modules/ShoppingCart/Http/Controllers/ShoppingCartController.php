<?php

namespace App\Modules\ShoppingCart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
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
    protected $shoppingItem;

    /**
     * @param ShoppingCartInterface $shoppingCart
     * @param ShoppingItemInterface $shoppingCart
     */
    public function __construct(
        ShoppingCartInterface $shoppingCart,
        ShoppingItemInterface $shoppingItem
    ) {
        $this->shoppingCart = $shoppingCart;
        $this->shoppingItem = $shoppingItem;
    }

    public function index()
    {
        $shoppingSession = userInfo()->shoppingSession ?? null;
        $shoppingItems = $shoppingSession ? $this->shoppingItem->getShoppingItemByShoppingSessionId(userInfo()->shoppingSession->id) : null;

        return view('client.cart.index', compact('shoppingSession', 'shoppingItems'));
    }


    public function addCart(Request $request)
    {
        $result = $this->shoppingCart->storeCart($request->all());

        return $result ? $this->responseSuccess(message: __('Sản phẩm đã được thêm vào giỏ hàng'), data: $result)
                : $this->responseFailed(message: __('Sản phẩm chưa được thêm vào giỏ hàng, vui lòng thử lại!'));
    }

    public function deleteItemCart(Request $request)
    {
        $result = $this->shoppingCart->deleteItemCart($request->id);

        return $result ? $this->responseSuccess(message: __('Xóa sản phẩm thành công'))
            : $this->responseFailed(message: __('Xóa sản phẩm thất bại, vui lòng thử lại!'));
    }

    public function updateCart(Request $request)
    {
        $result = $this->shoppingCart->updateCartItem($request->all());

        return $result ? $this->responseSuccess(message: __('Cập nhật thành công'))
            : $this->responseFailed(message: __('Cập nhật thất bại, vui lòng thử lại!'));
    }
}

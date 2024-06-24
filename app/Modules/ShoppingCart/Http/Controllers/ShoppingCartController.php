<?php

namespace App\Modules\ShoppingCart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Address\Interfaces\AddressShippingInterface;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use Illuminate\Http\Request;
use App\Modules\ShoppingCart\Interfaces\ShoppingCartInterface;

/**
 * @ShoppingCartController
 */
class ShoppingCartController extends Controller
{
    protected $shoppingcart;
    protected $shoppingItem;
    protected $addressShipping;

    /**
     * @param ShoppingCartInterface $shoppingCart
     * @param ShoppingItemInterface $shoppingCart
     * @param AddressShippingInterface $addressShipping
     */
    public function __construct(
        ShoppingCartInterface $shoppingCart,
        ShoppingItemInterface $shoppingItem,
        AddressShippingInterface $addressShipping,
    ) {
        $this->shoppingCart = $shoppingCart;
        $this->shoppingItem = $shoppingItem;
        $this->addressShipping = $addressShipping;
    }

    public function index(Request $request)
    {
        $shoppingSession = userInfo()->shoppingSession ?? null;
        $shoppingItems = $shoppingSession ? $this->shoppingItem->getShoppingItemByShoppingSessionId(userInfo()->shoppingSession->id, 5, $request->page) : null;
        $addressAct = $this->addressShipping->getAddressActByUserId(userInfo()->id);

        if ($request->ajax()) {
            $viewTable = view('client.cart.table', compact('shoppingItems'))->render();
            $viewCheckOut = view('client.cart.checkout', compact('shoppingSession', 'shoppingItems', 'addressAct'))->render();
            $paginate = view('client.pagination.index')->with(['data' => $shoppingItems])->render();

            return $this->responseSuccess(data: ['htmlTable' => $viewTable, 'htmlCheckout' => $viewCheckOut, 'pagination' => $paginate]);
        }

        return view('client.cart.index',
            compact('shoppingSession', 'shoppingItems', 'addressAct')
        );
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

        return $result ? $this->responseSuccess(message: __('Xóa sản phẩm thành công'), data: $result)
            : $this->responseFailed(message: __('Xóa sản phẩm thất bại, vui lòng thử lại!'));
    }

    public function updateCart(Request $request)
    {
        $result = $this->shoppingCart->updateCartItem($request->all());

        return $result ? $this->responseSuccess(message: __('Cập nhật thành công'))
            : $this->responseFailed(message: __('Cập nhật thất bại, vui lòng thử lại!'));
    }
}

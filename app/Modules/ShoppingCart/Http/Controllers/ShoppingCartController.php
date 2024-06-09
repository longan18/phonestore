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
    protected $productSmartphonePrice;

    /**
     * @param ShoppingCartInterface $shoppingcart
     * @param ProductSmartphonePriceInterface $productSmartphonePrice
     */
    public function __construct(
        ShoppingCartInterface $shoppingcart,
        ProductSmartphonePriceInterface $productSmartphonePrice
    ) {
        $this->shoppingcart = $shoppingcart;
        $this->productSmartphonePrice = $productSmartphonePrice;
    }

    public function addCart(Request $request)
    {
        $productPrice = $this->productSmartphonePrice->getById($request->item_id);

    }
}

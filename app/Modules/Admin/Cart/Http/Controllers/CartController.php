<?php

namespace App\Modules\Admin\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;

class CartController extends Controller
{
    protected $shoppingItem;

    /**
     * @param ShoppingItemInterface $shoppingItem
     */
    public function __construct(ShoppingItemInterface $shoppingItem) {
        $this->shoppingItem =  $shoppingItem;
    }

    public function index(User $user)
    {
        $carts = $user->shoppingSession ? $this->shoppingItem->getShoppingItemByShoppingSessionId($user->shoppingSession->id, 10) : [] ;
        return view('admin.cart.index', compact('carts', 'user'));
    }
}

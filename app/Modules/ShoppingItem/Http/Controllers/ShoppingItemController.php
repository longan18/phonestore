<?php

namespace App\Modules\ShoppingItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\ShoppingItem\Http\Requests\ShoppingItemRequest;
use App\Modules\ShoppingItem\Interfaces\ShoppingItemInterface;
use App\Modules\ShoppingItem\Models\ShoppingItem;

/**
 * @ShoppingItemController
 */
class ShoppingItemController extends Controller
{
    protected $shoppingitem;

    /**
     * @param ShoppingItemInterface $shoppingitem
     */
    public function __construct(ShoppingItemInterface $shoppingitem)
    {
        $this->shoppingitem = $shoppingitem;
    }
}

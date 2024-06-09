<?php

namespace App\Modules\ShoppingCart\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\ShoppingCart\Interfaces\ShoppingCartInterface;
use App\Modules\ShoppingCart\Models\ShoppingCart;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;

/**
 * @ShoppingCartService
 */
class ShoppingCartService extends BaseService implements ShoppingCartInterface
{
    protected $media;

    /**
     * @param ShoppingCart $shoppingcart
     * @param MediaInterface $media
     */
    public function __construct(ShoppingCart $shoppingcart, MediaInterface $media)
    {
        $this->model = $shoppingcart;
        $this->media = $media;
    }

    public function storeCart($data)
    {

    }
}

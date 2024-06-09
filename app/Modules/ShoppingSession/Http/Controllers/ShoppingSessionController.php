<?php

namespace App\Modules\ShoppingSession\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\ShoppingSession\Http\Requests\ShoppingSessionRequest;
use App\Modules\ShoppingSession\Interfaces\ShoppingSessionInterface;
use App\Modules\ShoppingSession\Models\ShoppingSession;

/**
 * @ShoppingSessionController
 */
class ShoppingSessionController extends Controller
{
    protected $shoppingsession;

    /**
     * @param ShoppingSessionInterface $shoppingsession
     */
    public function __construct(ShoppingSessionInterface $shoppingsession)
    {
        $this->shoppingsession = $shoppingsession;
    }
}

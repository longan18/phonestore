<?php

namespace App\Modules\Admin\Ram\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Ram\Http\Requests\RamRequest;
use App\Modules\Admin\Ram\Interfaces\RamInterface;
use App\Modules\Admin\Ram\Models\Ram;

/**
 * @RamController
 */
class RamController extends Controller
{
    protected $ram;

    /**
     * @param RamInterface $ram
     */
    public function __construct(RamInterface $ram)
    {
        $this->ram = $ram;
    }
}

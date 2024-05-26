<?php

namespace App\Modules\Admin\Color\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Color\Http\Requests\ColorRequest;
use App\Modules\Admin\Color\Interfaces\ColorInterface;
use App\Modules\Admin\Color\Models\Color;

/**
 * @ColorController
 */
class ColorController extends Controller
{
    protected $color;

    /**
     * @param ColorInterface $color
     */
    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }
}

<?php

namespace App\Modules\Admin\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\Category\Http\Requests\CategoryRequest;
use App\Modules\Admin\Category\Interfaces\CategoryInterface;
use App\Modules\Admin\Category\Models\Category;

/**
 * @CategoryController
 */
class CategoryController extends Controller
{
    protected $category;

    /**
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
}

<?php

namespace App\Modules\Admin\Product\Interfaces;

/**
 * @ProductInterface
 */
interface ProductInterface
{
    public function search($request, $categoryId);

    public function store($request);

    public function getDataFillable($request, $create);
}

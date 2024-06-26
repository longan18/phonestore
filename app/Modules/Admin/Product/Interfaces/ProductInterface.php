<?php

namespace App\Modules\Admin\Product\Interfaces;

/**
 * @ProductInterface
 */
interface ProductInterface
{
    public function search($request, $categoryId);

    public function createOrUpdate($request);

    public function delete($id);
}

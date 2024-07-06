<?php

namespace App\Modules\Admin\Product\Interfaces;

/**
 * @ProductInterface
 */
interface ProductInterface
{
    public function search($request);

    public function createOrUpdate($request);

    public function delete($id);
    public function getDataPageHome();

    public function getProductBySlug($slug);

    public function updateStatusProduct($model, $request);
    public function updateStatusByBrandId($brandId, $status);
}

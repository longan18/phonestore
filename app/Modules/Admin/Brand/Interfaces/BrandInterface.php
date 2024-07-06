<?php

namespace App\Modules\Admin\Brand\Interfaces;

/**
 * @BrandInterface
 */
interface BrandInterface
{
    public function handleBrand($request);
    public function search($request);

    public function updateStatusBrand($model, $request);
}

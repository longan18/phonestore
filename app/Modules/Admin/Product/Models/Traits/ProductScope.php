<?php

namespace App\Modules\Admin\Product\Models\Traits;

/**
 * @ProductScope
 */
trait ProductScope
{
    /**
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeSearch($query, $request, $categoryId): mixed
    {
        $withs = [
            'media',
            'brand',
            'category'
        ];

        if ($categoryId == CATEGORY_SAMRTPHONE) {
            array_push($withs, 'productSmartphone.productSmartphonePrice');
        }

        return $query->with($withs)
            ->where('category_id', $categoryId)
            ->when(
                !empty($request->key_search),
                    function ($q) use ($request) {
                        $q->where('name', 'like', '%' . escapeLike($request->key_search) . '%');
                    }
            )->when(
                !empty($request->brand_id),
                function ($q) use ($request) {
                    $q->where('brand_id', $request->brand_id);
                }
            )->when(
                !empty($request->status),
                    function ($q) use ($request) {
                        $q->where('products.status', $request->status);
                    }
            )->when(
                !empty($request->start_price) || !empty($request->end_price),
                function ($q) use ($request) {
                    $q->join('product_smartphone', 'products.id', '=', 'product_smartphone.product_id')
                        ->join('product_smartphone_price', 'product_smartphone.id', '=', 'product_smartphone_price.item_id');

                    if (!empty($request->start_price) && !empty($request->end_price)) {
                        $q->whereBetween('product_smartphone_price.price', [str_replace(',', '', $request->start_price), str_replace(',', '', $request->end_price)]);
                    } elseif (!empty($request->start_price)) {
                        $q->where('product_smartphone_price.price', '>=', str_replace(',', '', $request->start_price));
                    } elseif (!empty($request->end_price)) {
                        $q->where('product_smartphone_price.price', '<=', str_replace(',', '', $request->end_price));
                    }
                }
            )->when(
                !empty($request->start_date) || !empty($request->end_date),
                function ($q) use ($request) {
                    if (!empty($request->start_date) && !empty($request->end_date)) {
                        $q->whereBetween('products.created_at', [convertDateToDateTime($request->start_date), convertDateToDateTime($request->end_date)]);
                    } elseif (!empty($request->start_date)) {
                        $q->where('products.created_at', '>=', convertDateToDateTime($request->start_date));
                    } elseif (!empty($request->end_date)) {
                        $q->where('products.created_at', '<=', convertDateToDateTime($request->end_date));
                    }
                }
            );
    }
}

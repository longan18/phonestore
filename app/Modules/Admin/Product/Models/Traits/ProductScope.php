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
    public function scopeSearch($query, $request): mixed
    {
        $withs = [
            'media',
            'brand',
            'category',
            'productSmartphone',
            'productSmartphonePrice'
        ];

        return $query->with($withs)
            ->where('category_id', CATEGORY_SAMRTPHONE)
            ->when(!empty($request->key_search), function ($q) use ($request) {
                $q->where('name', 'like', '%' . escapeLike($request->key_search) . '%');
            }
            )->when(!empty($request->brand_id), function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            }
            )->when(!empty($request->status), function ($q) use ($request) {
                $q->where('products.status', $request->status);
            }
            )->when(!empty($request->start_price) || !empty($request->end_price),
                function ($q) use ($request) {
                    return $this->querySmartphonePrice($q, $request);
                }
            )->when(!empty($request->start_date) || !empty($request->end_date), function ($q) use ($request) {
                if (!empty($request->start_date) && !empty($request->end_date)) {
                    $q->whereBetween('products.created_at', [convertDateToDateTime($request->start_date), convertDateToDateTime($request->end_date)]);
                } elseif (!empty($request->start_date)) {
                    $q->where('products.created_at', '>=', convertDateToDateTime($request->start_date));
                } elseif (!empty($request->end_date)) {
                    $q->where('products.created_at', '<=', convertDateToDateTime($request->end_date));
                }
            });
    }

    private function querySmartphonePrice($query, $request)
    {
        $query = $query->join('product_smartphone_price', 'products.id', '=', 'product_smartphone_price.product_id');

        if (!empty($request->start_price) && !empty($request->end_price)) {
            $query->whereBetween('product_smartphone_price.price', [str_replace(',', '', $request->start_price), str_replace(',', '', $request->end_price)]);
        } elseif (!empty($request->start_price)) {
            $query->where('product_smartphone_price.price', '>=', str_replace(',', '', $request->start_price));
        } elseif (!empty($request->end_price)) {
            $query->where('product_smartphone_price.price', '<=', str_replace(',', '', $request->end_price));
        }

        return $query->select('products.*')->groupBy('products.id');
    }
}

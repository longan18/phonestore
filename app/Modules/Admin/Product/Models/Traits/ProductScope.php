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
        return $query->with(['media', 'brand', 'category'])->where('category_id', $categoryId)
            ->when(!empty($request->key_search), function ($q) use ($request) {
                $q->where('name', 'like', '%' . escapeLike($request->key_search) . '%');
            });
    }
}

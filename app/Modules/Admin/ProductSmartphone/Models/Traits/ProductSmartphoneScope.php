<?php

namespace App\Modules\Admin\ProductSmartphone\Models\Traits;

/**
 * @ProductSmartphoneScope
 */
trait ProductSmartphoneScope
{
    /**
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeSearch($query, $request): mixed
    {
        return $query->with(['media'])->when(!empty($request->key_search), function ($q) use ($request) {
            $q->where('name', 'like', '%' . escapeLike($request->key_search) . '%');
        });
    }
}

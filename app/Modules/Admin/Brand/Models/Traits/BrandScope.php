<?php

namespace App\Modules\Admin\Brand\Models\Traits;

use App\Enums\Status;

/**
 * @BrandScope
 */
trait BrandScope
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

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetPublish($query): mixed
    {
        return $query->where('status', Status::Publish->value);
    }
}

<?php

namespace App\Modules\Media\Interfaces;

/**
 * Interface AccountAdminInterface
 *
 * @package App\Modules\Admin\Account\Interfaces
 */
interface MediaInterface
{
    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function uploadAvatar($model, $request);

    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function uploadSubImage($model, $request);
}

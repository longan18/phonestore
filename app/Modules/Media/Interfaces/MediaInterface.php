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
     * @param $directory
     * @return mixed
     */
    public function uploadAvatar($model, $request, $directory);

    /**
     * @param $model
     * @param $request
     * @param $directory
     * @return mixed
     */
    public function uploadSubImage($model, $request, $directory);
}

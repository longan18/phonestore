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
     * @param $fileName
     * @param $directory
     * @param $tagName
     * @return mixed
     */
    public function uploadAvatar($model, $request, $fileName, $directory, $tagName);

    /**
     * @param $model
     * @param $request
     * @param $directory
     * @param $tagName
     * @return mixed
     */
    public function uploadSubImage($model, $request, $directory, $tagName);
}

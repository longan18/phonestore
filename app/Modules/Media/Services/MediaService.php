<?php

namespace App\Modules\Media\Services;

use App\Enums\TagMedia;
use Exception;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Modules\Media\Models\Media;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\HandlesMediaUploadExceptions;
use Plank\Mediable\MediaUploader;

/**
 * Class MediaService
 *
 * @package App\Modules\Media\Services
 */
class MediaService extends BaseService implements MediaInterface
{
    use HandlesMediaUploadExceptions;

    protected MediaUploader $mediaUploader;

    /**
     * MediaService constructor.
     *
     * @param Media         $media
     * @param MediaUploader $mediaUploader
     */
    public function __construct(Media $media, MediaUploader $mediaUploader)
    {
        $this->model = $media;
        $this->mediaUploader = $mediaUploader;
    }

    /**
     * @param $model
     * @param $request
     * @return void
     */
    public function uploadAvatar($model, $request, $directory = 'product')
    {
        if ($model) {
            if ($request->hasFile('avatar')) {
                $media = $this->upload($request->file('avatar'), directory: $directory);
            }
            if (!empty($media) && $model->hasMedia(TagMedia::Avatar->value)) {
                $this->deleteExistingFile($model->getMedia(TagMedia::Avatar->value)->first());
            }

            empty($media) ?: $model->syncMedia($media, TagMedia::Avatar->value);
        }
    }

    /**
     * @param $request
     * @param $model
     */
    public function uploadSubImage($model, $request, $directory = 'product')
    {
        if ($model) {
            $media = [];
            if (!empty($request->sub_image)) {
                foreach ($request->sub_image as $sub) {
                    $upload = $this->upload($sub, directory: $directory);
                    if ($upload->id) {
                        $media[] = $upload->id;
                    }
                }
            }
            if (!empty($request->sub_image_remove)) {
                $this->deleteExistingFile($model->getSubImageByIdMethod($request->sub_image_remove), false);
                $model->detachMedia($request->sub_image_remove);
            }
            empty($media) ?: $model->attachMedia($media, TagMedia::SubImage->value);
        }
    }

    /**
     * @param        $file
     * @param string $disk
     * @param null   $directory
     *
     * @return \Plank\Mediable\Media
     * @throws Exception
     */
    private function upload($file, $disk = 'public', $directory = null): \Plank\Mediable\Media
    {
        try {
            return $this->mediaUploader
                ->fromSource($file)
                ->toDestination($disk, $directory)
                ->useFilename(Str::random(40) . time())
                ->upload();
        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        }
    }

    /**
     * @param      $media
     * @param bool $is_first
     *
     * @return void
     */
    public function deleteExistingFile($media, bool $is_first = true): void
    {
        if (!$is_first && $media) {
            foreach ($media as $value) {
                $value->delete();
                Storage::disk($value->disk)->delete($value->getDiskPath());
            }
        } else if($media) {
            $media->delete();
            Storage::disk($media->disk)->delete($media->getDiskPath());
        }
    }
}

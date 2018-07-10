<?php

namespace Omnispear\Media\Controllers;

use Intervention\Image\Facades\Image;
use Omnispear\Media\Models\Media;
use Omnispear\Media\Requests\MediaImageRequest;

class MediaController extends Controller
{
    /**
     * Download an existing media item to storage
     *
     * @param Media $media
     * @return mixed
     */
    public function download(Media $media)
    {
        return response()->download(storage_path() . '/app/files/' . $media->storage_location);
    }

    /**
     * Gets an image from media
     *
     * @param MediaImageRequest $request
     * @param Media $media
     * @return array
     */
    public function image(MediaImageRequest $request, Media $media)
    {
        $path = storage_path() . '/app/files/' . $media->storage_location;
        $size = getimagesize($path);

        if (is_array($size)) {
            $image = Image::cache(function ($image) use ($path, $request) {
                $image->make($path)->orientate();

                if ($request->has('width') && $request->has('height')) {
                    $image->resize($request->get('width'), $request->get('height'));
                }
            }, 60 * 60 * 1000 * 24, true);

            return $image->response($request->has('type') ? $request->get('type') : 'jpg');
        }

        return [
            'error' => true,
            'messages' => []
        ];
    }

    /**
     * Gets an image associated with the media item
     *
     * @param Media $media
     * @return mixed
     */
    public function doc(Media $media)
    {
        return response()->file(storage_path() . '/app/files/' . $media->storage_location);
    }
}
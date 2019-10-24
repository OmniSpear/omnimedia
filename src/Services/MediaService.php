<?php

namespace Omnispear\Media\Services;

use Omnispear\Media\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MediaService
 * @package Omnispear\Media\Services
 *
 * "Helper functions" for Media creation and finding
 */
class MediaService
{
    /**
     * Turns an uploaded file into a Media object that is stored into the database
     *
     * @param UploadedFile $file
     * @return null|Media
     */
    public function createFromFile(UploadedFile $file) {

        if ($file->isValid()) {
            $newFileName = uniqid() . "_" . $file->getClientOriginalName();
            $file->move(storage_path('app/files'), $newFileName);

            touch($file->getPathname());

            $media = Media::create([
                'type' => $file->getMimeType(),
                'storage_location' => $newFileName,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getClientSize()
            ]);

            return $media;
        }

        return null;
    }

    /**
     * Finds a media item from storage
     *
     * @param $value
     * @return mixed
     */
    public function find($value) {
        $media = Media::whereStorageLocation($value)->first();

        if (!$media) {
            $media = Media::findOrFail($value);
        }

        return $media;
    }
}
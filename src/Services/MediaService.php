<?php namespace Omnispear\Media\Services;

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
     * Turns an uploaded file into a Media object that is stored into the database.
     * 
     * @param UploadedFile $file
     * @return null|Media
     */
    public function createFromFile(UploadedFile $file) {

        if($file->isValid()) {
            $mime = $file->getMimeType();
            $newFileName = uniqid() . "_" . $file->getClientOriginalName();
            $file->move(storage_path('app/files'), $newFileName);

            $media = new Media();
            $media->type = $mime;
            $media->storage_location = $newFileName;
            $media->file_name = $file->getClientOriginalName();
            $media->save();
            
            return $media;
        }

        return null;
    }

    public function find($value) {
        $media = Media::whereStorageLocation($value)->first();
        if(!$media) {
            $media = Media::findOrFail($value);
        }

        return $media;
    }
}
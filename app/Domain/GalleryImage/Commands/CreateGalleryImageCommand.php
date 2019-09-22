<?php

namespace App\Domain\GalleryImage\Commands;

use App\GalleryImage;
use App\Services\UploadImagesService;

/**
 * Class CreateGalleryImageCommand
 * @package App\Domain\GalleryImage\Commands
 */
class CreateGalleryImageCommand
{

    private $uploadImage;

    /**
     * CreateGalleryImageCommand constructor.
     * @param UploadImagesService $uploadImage
     */
    public function __construct(UploadImagesService $uploadImage)
    {
        $this->uploadImage = $uploadImage;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $galleryImage = new GalleryImage();
        $galleryImage->basename = $this->uploadImage->getImageHashName();
        $galleryImage->ext = $this->uploadImage->getExt();
        $galleryImage->gallery_id = $this->uploadImage->getEntityId();

        return $galleryImage->save();
    }

}
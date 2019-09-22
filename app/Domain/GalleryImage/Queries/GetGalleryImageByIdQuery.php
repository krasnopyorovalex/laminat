<?php

namespace App\Domain\GalleryImage\Queries;

use App\GalleryImage;

/**
 * Class GetGalleryImageByIdQuery
 * @package App\Domain\GalleryImage\Queries
 */
class GetGalleryImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetGalleryImageByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return GalleryImage::findOrFail($this->id);
    }
}
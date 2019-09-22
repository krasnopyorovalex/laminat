<?php

namespace App\Domain\Gallery\Queries;

use App\Gallery;

/**
 * Class GetAllGalleryImagesQuery
 * @package App\Domain\Gallery\Queries
 */
class GetAllGalleryImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Gallery::all();
    }
}
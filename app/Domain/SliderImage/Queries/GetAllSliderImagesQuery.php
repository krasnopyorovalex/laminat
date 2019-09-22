<?php

namespace App\Domain\Gallery\Queries;

use App\Slider;

/**
 * Class GetAllSliderImagesQuery
 * @package App\Domain\Gallery\Queries
 */
class GetAllSliderImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Slider::all();
    }
}
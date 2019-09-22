<?php

namespace App\Domain\SliderImage\Queries;

use App\SliderImage;

/**
 * Class GetSliderImageByIdQuery
 * @package App\Domain\SliderImage\Queries
 */
class GetSliderImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetSliderImageByIdQuery constructor.
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
        return SliderImage::findOrFail($this->id);
    }
}
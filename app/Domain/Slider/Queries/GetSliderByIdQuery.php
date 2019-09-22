<?php

namespace App\Domain\Slider\Queries;

use App\Slider;

/**
 * Class GetSliderByIdQuery
 * @package App\Domain\Page\Queries
 */
class GetSliderByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetSliderByIdQuery constructor.
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
        return Slider::with(['images'])->findOrFail($this->id);
    }
}
<?php

namespace App\Domain\Slider\Queries;

use App\Slider;

/**
 * Class GetAllSlidersQuery
 * @package App\Domain\Slider\Queries
 */
class GetAllSlidersQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Slider::all();
    }
}
<?php

namespace App\Domain\Filter\Queries;

use App\Filter;

/**
 * Class GetAllFiltersQuery
 * @package App\Domain\Filter\Queries
 */
class GetAllFiltersQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Filter::orderBy('pos')->get();
    }
}

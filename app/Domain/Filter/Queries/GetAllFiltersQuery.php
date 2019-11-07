<?php

namespace App\Domain\Filter\Queries;

use App\Filter;
use Illuminate\Support\Collection;

/**
 * Class GetAllFiltersQuery
 * @package App\Domain\Filter\Queries
 */
class GetAllFiltersQuery
{
    /**
     * @return Collection
     */
    public function handle(): Collection
    {
        return Filter::orderBy('pos')->get();
    }
}

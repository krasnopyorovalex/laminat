<?php

namespace App\Domain\FilterOption\Queries;

use App\FilterOption;

/**
 * Class GetAllFilterOptionsQuery
 * @package App\Domain\FilterOption\Queries
 */
class GetAllFilterOptionsQuery
{
    /**
     * @var int
     */
    private $filter;

    /**
     * GetAllFilterOptionsQuery constructor.
     * @param int $filter
     */
    public function __construct(int $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return FilterOption::where('filter_id', $this->filter)->get();
    }
}

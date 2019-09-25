<?php

namespace App\Domain\FilterOption\Queries;

use App\FilterOption;

/**
 * Class GetFilterOptionByIdQuery
 * @package App\Domain\FilterOption\Queries
 */
class GetFilterOptionByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetFilterOptionByIdQuery constructor.
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
        return FilterOption::findOrFail($this->id);
    }
}

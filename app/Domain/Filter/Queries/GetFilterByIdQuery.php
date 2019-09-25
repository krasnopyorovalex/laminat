<?php

namespace App\Domain\Filter\Queries;

use App\Filter;

/**
 * Class GetFilterByIdQuery
 * @package App\Domain\Filter\Queries
 */
class GetFilterByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetFilterByIdQuery constructor.
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
        return Filter::findOrFail($this->id);
    }
}

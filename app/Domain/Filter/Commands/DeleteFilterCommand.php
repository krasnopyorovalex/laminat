<?php

namespace App\Domain\Filter\Commands;

use App\Domain\Filter\Queries\GetFilterByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteFilterCommand
 * @package App\Domain\Filter\Commands
 */
class DeleteFilterCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteFilterCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $filter = $this->dispatch(new GetFilterByIdQuery($this->id));

        return $filter->delete();
    }

}

<?php

namespace App\Domain\FilterOption\Commands;

use App\Domain\FilterOption\Queries\GetFilterOptionByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteFilterOptionCommand
 * @package App\Domain\FilterOption\Commands
 */
class DeleteFilterOptionCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteCatalogCommand constructor.
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
        $filterOption = $this->dispatch(new GetFilterOptionByIdQuery($this->id));

        return $filterOption->delete();
    }
}

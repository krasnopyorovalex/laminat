<?php

namespace App\Domain\MenuItem\Commands;

use App\Domain\MenuItem\Queries\GetMenuItemByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteMenuItemCommand
 * @package App\Domain\MenuItem\Commands
 */
class DeleteMenuItemCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteMenuItemCommand constructor.
     * @param $id
     */
    public function __construct($id)
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
        $menuItem = $this->dispatch(new GetMenuItemByIdQuery($this->id));

        return $menuItem->delete();
    }

}
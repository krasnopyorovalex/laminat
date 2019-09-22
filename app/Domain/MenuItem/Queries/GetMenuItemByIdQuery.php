<?php

namespace App\Domain\MenuItem\Queries;

use App\MenuItem;

/**
 * Class GetMenuItemByIdQuery
 * @package App\Domain\MenuItem\Queries
 */
class GetMenuItemByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetMenuItemByIdQuery constructor.
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
        return MenuItem::findOrFail($this->id);
    }
}
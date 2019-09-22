<?php

namespace App\Domain\Menu\Queries;

use App\Menu;

/**
 * Class GetMenuByIdQuery
 * @package App\Domain\Menu\Queries
 */
class GetMenuByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetCustomerByIdQuery constructor.
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
        return Menu::findOrFail($this->id);
    }
}
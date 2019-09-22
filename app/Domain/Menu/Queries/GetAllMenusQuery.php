<?php

namespace App\Domain\Menu\Queries;

use App\Menu;

/**
 * Class GetAllMenusQuery
 * @package App\Domain\Menu\Queries
 */
class GetAllMenusQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Menu::all();
    }
}
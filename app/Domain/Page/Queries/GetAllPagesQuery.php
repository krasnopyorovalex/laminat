<?php

namespace App\Domain\Page\Queries;

use App\Page;

/**
 * Class GetAllPagesQuery
 * @package App\Domain\Page\Queries
 */
class GetAllPagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Page::all();
    }
}
<?php

namespace App\Domain\Catalog\Queries;

use App\Catalog;

/**
 * Class GetAllCatalogsWithoutParentQuery
 * @package App\Domain\Catalog\Queries
 */
class GetAllCatalogsWithoutParentQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Catalog::with(['products','catalogs'])->where('parent_id', null)->orderBy('pos')->get();
    }
}

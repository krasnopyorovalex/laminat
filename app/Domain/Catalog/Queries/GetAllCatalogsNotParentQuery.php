<?php

namespace App\Domain\Catalog\Queries;

use App\Catalog;

/**
 * Class GetAllCatalogsNotParentQuery
 * @package App\Domain\Catalog\Queries
 */
class GetAllCatalogsNotParentQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Catalog::where('parent_id')->with(['catalogs' => static function($query){
            return $query->with(['catalogs']);
        }])->orderBy('pos')->get();
    }
}

<?php

namespace App\Domain\CatalogProduct\Queries;

use App\Catalog;
use App\CatalogProduct;
use App\Filter\CatalogProductFilter;

/**
 * Class GetAllCatalogProductsWithFilterQuery
 * @property Catalog catalog
 * @package App\Domain\CatalogProduct\Queries
 */
class GetAllCatalogProductsWithFilterQuery
{
    /**
     * @var Catalog
     */
    private $catalog;
    /**
     * @var CatalogProductFilter
     */
    private $catalogProductFilter;

    /**
     * GetAllCatalogProductsWithFilterQuery constructor.
     * @param Catalog $catalog
     * @param CatalogProductFilter $catalogProductFilter
     */
    public function __construct(Catalog $catalog, CatalogProductFilter $catalogProductFilter)
    {
        $this->catalog = $catalog;
        $this->catalogProductFilter = $catalogProductFilter;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return CatalogProduct::whereCatalogId($this->catalog->id)
            ->byFilter($this->catalogProductFilter)
            ->paginate(3);
    }
}

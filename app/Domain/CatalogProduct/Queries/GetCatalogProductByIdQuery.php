<?php

namespace App\Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class GetCatalogProductByIdQuery
 * @package App\Domain\CatalogProduct\Queries
 */
class GetCatalogProductByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetCatalogProductByIdQuery constructor.
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
        return CatalogProduct::findOrFail($this->id);
    }
}

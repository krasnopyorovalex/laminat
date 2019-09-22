<?php

namespace App\Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class ExistsCatalogProductByNameQuery
 * @package App\Domain\CatalogProduct\Queries
 */
class ExistsCatalogProductByNameQuery
{
    /**
     * @var string
     */
    private $name;

    /**
     * ExistsCatalogProductByNameQuery constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return CatalogProduct::where('name', $this->name)->firstOrFail();
    }
}

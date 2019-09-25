<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Domain\Catalog\Queries\GetCatalogByAliasQuery;
use App\Domain\CatalogProduct\Queries\GetAllCatalogProductsWithFilterQuery;
use App\Filter\CatalogProductFilter;
use App\Services\CanonicalService;
use App\Services\TextParserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CatalogController
 * @package App\Http\Controllers
 */
class CatalogController extends PageController
{
    /**
     * @var CatalogProductFilter
     */
    private $catalogProductFilter;

    /**
     * CatalogController constructor.
     *
     * @param TextParserService $parserService
     * @param CanonicalService $canonicalService
     * @param CatalogProductFilter $catalogProductFilter
     */
    public function __construct(
        TextParserService $parserService,
        CanonicalService $canonicalService,
        CatalogProductFilter $catalogProductFilter
    ) {
        parent::__construct($parserService, $canonicalService);

        $this->catalogProductFilter = $catalogProductFilter;
    }

    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias = 'index')
    {
        try {

            /** @var $catalog Catalog*/
            $catalog = $this->dispatch(new GetCatalogByAliasQuery($alias));
            $catalog->text = $this->parserService->parse($catalog);

            $catalog = $this->canonicalService->check($catalog);

            $products = $this->dispatch(new GetAllCatalogProductsWithFilterQuery($catalog, $this->catalogProductFilter));

        } catch (Exception $exception) {
            return parent::show($alias);
        }

        return view($catalog->getTemplate(), [
            'catalog' => $catalog,
            'products' => $products
        ]);
    }
}

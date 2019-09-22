<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Domain\Catalog\Queries\GetCatalogByAliasQuery;
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
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias = 'index')
    {
        try {

            /** @var $catalog Catalog*/
            $catalog = $this->dispatch(new GetCatalogByAliasQuery($alias));
            $catalog->text = $this->parserService->parse($catalog);

        } catch (Exception $exception) {
            return parent::show($alias);
        }

        return view($catalog->getTemplate(), ['catalog' => $catalog]);
    }
}

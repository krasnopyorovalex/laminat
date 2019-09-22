<?php

namespace App\Http\ViewComposers;

use App\Domain\Catalog\Queries\GetAllCatalogsWithoutParentQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CatalogComposer
 * @package App\Http\ViewComposers
 */
class CatalogComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $catalog = $this->dispatch(new GetAllCatalogsWithoutParentQuery());

        $view->with('catalog', $catalog);
    }
}

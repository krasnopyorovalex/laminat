<?php

namespace App\Http\ViewComposers;

use App\Domain\Filter\Queries\GetAllFiltersQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FilterComposer
 * @package App\Http\ViewComposers
 */
class FilterComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $filters = $this->dispatch(new GetAllFiltersQuery());

        $view->with('filters', $filters);
    }
}

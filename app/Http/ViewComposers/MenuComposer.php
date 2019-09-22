<?php

namespace App\Http\ViewComposers;

use App\Domain\Menu\Queries\GetAllMenuWithMenuItemsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MenuComposer
 * @package App\Http\ViewComposers
 */
class MenuComposer
{

    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $menus = $this->dispatch(new GetAllMenuWithMenuItemsQuery());

        $reindexed = $menus->mapWithKeys(function ($item) {
            return [$item->sys_name => $item->menuItems];
        });

        $view->with('menu', $reindexed);
    }
}
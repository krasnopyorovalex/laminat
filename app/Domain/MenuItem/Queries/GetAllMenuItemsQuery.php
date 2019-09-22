<?php

namespace App\Domain\MenuItem\Queries;

use App\MenuItem;

/**
 * Class GetAllMenuItemsQuery
 * @package App\Domain\MenuItem\Queries
 */
class GetAllMenuItemsQuery
{

    private  $id;
    private  $excludeMenuItem;

    /**
     * GetAllMenuItemsQuery constructor.
     * @param int $id
     * @param MenuItem|null $excludeMenuItem
     */
    public function __construct(int $id, ?MenuItem $excludeMenuItem)
    {
        $this->id = $id;
        $this->excludeMenuItem = $excludeMenuItem;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $menuItems = MenuItem::with(['menuItems' => function($query) {
            return ($this->excludeMenuItem
                ? ($query->where('id', '!=', $this->excludeMenuItem->id)->with(['menuItems' => function($query) {
                    return ($this->excludeMenuItem
                        ? $query->where('id', '!=', $this->excludeMenuItem->id)
                        : []);
                }]))
                : []);
        }])
            ->where('menu_id', $this->id)
            ->where('parent_id', null)
            ->orderBy('pos');

        $this->excludeMenuItem
            ? $menuItems->where('id', '!=', $this->excludeMenuItem->id)
            : [];

        return $menuItems->get();
    }
}
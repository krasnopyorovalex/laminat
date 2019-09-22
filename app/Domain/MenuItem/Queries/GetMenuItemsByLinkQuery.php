<?php

namespace App\Domain\MenuItem\Queries;

use App\MenuItem;

/**
 * Class GetMenuItemsByLinkQuery
 * @package App\Domain\MenuItem\Queries
 */
class GetMenuItemsByLinkQuery
{
    /**
     * @var string
     */
    private $link;

    /**
     * GetMenuItemsByLinkQuery constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->link = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return MenuItem::where(['link' => $this->link])->get();
    }
}
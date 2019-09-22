<?php

namespace App\Domain\MenuItem\Commands;

use App\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateMenuItemsPositionsCommand
 * @package App\Domain\MenuItem\Commands
 */
class UpdateMenuItemsPositionsCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdateMenuItemsPositionsCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        foreach ($this->request->post() as $key => $value) {
            MenuItem::findOrFail(intval($key))->update([
                'pos' => intval($value['pos']),
                'parent_id' => $value['parent_id']
            ]);
        }
        return true;
    }

}
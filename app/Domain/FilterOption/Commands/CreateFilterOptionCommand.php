<?php

namespace App\Domain\FilterOption\Commands;

use App\Http\Requests\Request;
use App\FilterOption;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateFilterOptionCommand
 * @package App\Domain\FilterOption\Commands
 */
class CreateFilterOptionCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateCatalogCommand constructor.
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
        $filterOption = new FilterOption();
        $filterOption->fill($this->request->all());

        return $filterOption->save();
    }
}

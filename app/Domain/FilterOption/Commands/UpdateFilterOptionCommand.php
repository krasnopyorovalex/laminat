<?php

namespace App\Domain\FilterOption\Commands;

use App\Domain\FilterOption\Queries\GetFilterOptionByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFilterOptionCommand
 * @package App\Domain\FilterOption\Commands
 */
class UpdateFilterOptionCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateCatalogCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $filterOption = $this->dispatch(new GetFilterOptionByIdQuery($this->id));

        return $filterOption->update($this->request->all());
    }
}

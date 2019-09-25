<?php

namespace App\Domain\Filter\Commands;

use App\Domain\Filter\Queries\GetFilterByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFilterCommand
 * @package App\Domain\Filter\Commands
 */
class UpdateFilterCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateFilterCommand constructor.
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
        $filter = $this->dispatch(new GetFilterByIdQuery($this->id));

        return $filter->update($this->request->all());
    }

}

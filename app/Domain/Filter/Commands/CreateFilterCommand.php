<?php

namespace App\Domain\Filter\Commands;

use App\Http\Requests\Request;
use App\Filter;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateFilterCommand
 * @package App\Domain\Filter\Commands
 */
class CreateFilterCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateFilterCommand constructor.
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
        $filter = new Filter();
        $filter->fill($this->request->all());

        return $filter->save();
    }

}

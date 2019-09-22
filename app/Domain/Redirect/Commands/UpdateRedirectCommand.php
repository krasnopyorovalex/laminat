<?php

namespace App\Domain\Redirect\Commands;

use App\Domain\Redirect\Queries\GetRedirectByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateRedirectCommand
 * @package App\Domain\Redirect\Commands
 */
class UpdateRedirectCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateRedirectCommand constructor.
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
        $redirect = $this->dispatch(new GetRedirectByIdQuery($this->id));

        return $redirect->update($this->request->all());
    }

}
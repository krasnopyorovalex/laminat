<?php

namespace App\Domain\Redirect\Commands;

use App\Http\Requests\Request;
use App\Redirect;

/**
 * Class CreateRedirectCommand
 * @package App\Domain\Redirect\Commands
 */
class CreateRedirectCommand
{

    private $request;

    /**
     * CreateRedirectCommand constructor.
     * @param $request
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
        $redirect = new Redirect();
        $redirect->fill($this->request->all());

        return $redirect->save();
    }

}
<?php

namespace App\Domain\Redirect\Queries;


use App\Redirect;

/**
 * Class GetAllRedirectsQuery
 * @package App\Domain\Redirect\Queries
 */
class GetAllRedirectsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Redirect::all();
    }
}
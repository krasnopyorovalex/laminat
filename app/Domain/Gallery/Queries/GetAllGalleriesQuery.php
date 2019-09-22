<?php

namespace App\Domain\Gallery\Queries;

use App\Gallery;

/**
 * Class GetAllGalleriesQuery
 * @package App\Domain\Gallery\Queries
 */
class GetAllGalleriesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Gallery::all();
    }
}
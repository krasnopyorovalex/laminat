<?php

namespace App\Domain\Gallery\Queries;

use App\Gallery;

/**
 * Class GetGalleryByIdQuery
 * @package App\Domain\Page\Queries
 */
class GetGalleryByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetGalleryByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Gallery::with(['images'])->findOrFail($this->id);
    }
}
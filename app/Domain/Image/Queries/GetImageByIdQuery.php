<?php

namespace App\Domain\Image\Queries;

use App\Image;

/**
 * Class GetImageByIdQuery
 * @package App\Domain\Image\Queries
 */
class GetImageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetImageByIdQuery constructor.
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
        return Image::findOrFail($this->id);
    }
}
<?php

namespace App\Domain\Gallery\Commands;

use App\Domain\Gallery\Queries\GetGalleryByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteGalleryCommand
 * @package App\Domain\Gallery\Commands
 */
class DeleteGalleryCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteGalleryCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $gallery = $this->dispatch(new GetGalleryByIdQuery($this->id));

        \Storage::deleteDirectory('public/gallery/' . $this->id);

        return $gallery->delete();
    }

}
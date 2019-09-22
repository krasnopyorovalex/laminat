<?php

namespace App\Domain\GalleryImage\Commands;

use App\Domain\GalleryImage\Queries\GetGalleryImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteGalleryImageCommand
 * @package App\Domain\GalleryImage\Commands
 */
class DeleteGalleryImageCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteGalleryImageCommand constructor.
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
        $image = $this->dispatch(new GetGalleryImageByIdQuery($this->id));

        \Storage::delete([
            'public/gallery/' . $image->gallery_id . '/' . $image->basename . '.' . $image->ext,
            'public/gallery/' . $image->gallery_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
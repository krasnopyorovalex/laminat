<?php

namespace App\Domain\GalleryImage\Commands;

use App\Domain\GalleryImage\Queries\GetGalleryImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsGalleryImageCommand
 * @package App\Domain\GalleryImage\Commands
 */
class UpdatePositionsGalleryImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsGalleryImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if( is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetGalleryImageByIdQuery($imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
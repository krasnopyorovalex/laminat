<?php

namespace App\Domain\GalleryImage\Commands;

use App\Domain\GalleryImage\Queries\GetGalleryImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateGalleryImageCommand
 * @package App\Domain\GalleryImage\Commands
 */
class UpdateGalleryImageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateGalleryImageCommand constructor.
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
        $image = $this->dispatch(new GetGalleryImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}
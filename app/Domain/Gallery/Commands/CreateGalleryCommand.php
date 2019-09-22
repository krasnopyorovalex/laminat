<?php

namespace App\Domain\Gallery\Commands;

use App\Gallery;

/**
 * Class CreateGalleryCommand
 * @package App\Domain\Gallery\Commands
 */
class CreateGalleryCommand
{

    private $request;

    /**
     * CreateGalleryCommand constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $page = new Gallery();
        $page->fill($this->request->all());

        return $page->save();
    }

}
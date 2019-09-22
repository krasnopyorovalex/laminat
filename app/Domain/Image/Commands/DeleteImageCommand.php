<?php

namespace App\Domain\Image\Commands;

use App\Image;

/**
 * Class DeleteImageCommand
 * @package App\Domain\Image\Commands
 */
class DeleteImageCommand
{
    private $image;

    /**
     * DeleteImageCommand constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function handle(): bool
    {
        $path = str_replace('/storage/', '/public/', $this->image->path);
        \Storage::delete($path);

        return $this->image->delete();
    }

}
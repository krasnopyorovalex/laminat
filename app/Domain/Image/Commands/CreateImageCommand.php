<?php

namespace App\Domain\Image\Commands;

use App\Image;

/**
 * Class CreateImageCommand
 * @package App\Domain\Image\Commands
 */
class CreateImageCommand
{

    /**
     * @var array
     */
    private $data;

    /**
     * CreateImageCommand constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $image = new Image();
        $image->fill($this->data);

        return $image->save();
    }

}
<?php

namespace App\Domain\Image\Commands;

use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UploadImageCommand
 * @package App\Domain\Image\Commands
 */
class UploadImageCommand
{
    use DispatchesJobs;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var int
     */
    private $imageableId;

    /**
     * @var string
     */
    private $imageableType;

    /**
     * UploadImageCommand constructor.
     * @param Request $request
     * @param int $imageableId
     * @param string $imageableType
     */
    public function __construct(Request $request, int $imageableId, string $imageableType)
    {
        $this->request = $request;
        $this->imageableId = $imageableId;
        $this->imageableType = $imageableType;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $path = $this->request->file('image')->store('public/images');

        return $this->dispatch(new CreateImageCommand([
            'path' => \Storage::url($path),
            'imageable_id' => $this->imageableId,
            'imageable_type' => $this->imageableType
        ]));
    }

}
<?php

namespace App\Domain\Image\Commands;

use App\Domain\Image\Queries\GetImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateImageCommand
 * @package App\Domain\Image\Commands
 */
class UpdateImageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdatePageCommand constructor.
     * @param Request $request
     * @param int $id
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
        $image = $this->dispatch(new GetImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}
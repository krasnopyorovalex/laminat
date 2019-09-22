<?php

namespace App\Domain\SliderImage\Commands;

use App\Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsSliderImageCommand
 * @package App\Domain\SliderImage\Commands
 */
class UpdatePositionsSliderImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsSliderImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if ( is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetSliderImageByIdQuery($imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
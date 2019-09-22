<?php

namespace App\Domain\SliderImage\Commands;

use App\Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteSliderImageCommand
 * @package App\Domain\SliderImage\Commands
 */
class DeleteSliderImageCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteSliderImageCommand constructor.
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
        $image = $this->dispatch(new GetSliderImageByIdQuery($this->id));

        \Storage::delete([
            'public/slider/' . $image->slider_id . '/' . $image->basename . '.' . $image->ext,
            'public/slider/' . $image->slider_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
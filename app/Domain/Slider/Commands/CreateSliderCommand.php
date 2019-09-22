<?php

namespace App\Domain\Slider\Commands;

use App\Slider;

/**
 * Class CreateSliderCommand
 * @package App\Domain\Slider\Commands
 */
class CreateSliderCommand
{

    private $request;

    /**
     * CreateSliderCommand constructor.
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
        $slider = new Slider();
        $slider->fill($this->request->all());

        return $slider->save();
    }

}
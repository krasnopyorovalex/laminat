<?php

namespace App\Domain\Slider\Commands;

use App\Domain\Slider\Queries\GetSliderByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateSliderCommand
 * @package App\Domain\Slider\Commands
 */
class UpdateSliderCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateSliderCommand constructor.
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
        $page = $this->dispatch(new GetSliderByIdQuery($this->id));

        return $page->update($this->request->all());
    }

}
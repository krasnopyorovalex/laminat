<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Slider\Commands\CreateSliderCommand;
use App\Domain\Slider\Commands\DeleteSliderCommand;
use App\Domain\Slider\Commands\UpdateSliderCommand;
use App\Domain\Slider\Queries\GetAllSlidersQuery;
use App\Domain\Slider\Queries\GetSliderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Slider\Requests\CreateSliderRequest;
use Domain\SliderImage\Requests\UpdateSliderImageRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->dispatch(new GetAllSlidersQuery());

        return view('admin.sliders.index', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSliderRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateSliderRequest $request)
    {
        $this->dispatch(new CreateSliderCommand($request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($id));

        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * @param $id
     * @param UpdateSliderImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateSliderImageRequest $request)
    {
        $this->dispatch(new UpdateSliderCommand($id, $request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteSliderCommand($id));

        return redirect(route('admin.sliders.index'));
    }
}

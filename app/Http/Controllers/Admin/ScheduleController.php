<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Schedule\Commands\CreateScheduleCommand;
use App\Domain\Schedule\Commands\DeleteScheduleCommand;
use App\Domain\Schedule\Commands\UpdateScheduleCommand;
use App\Domain\Schedule\Queries\GetAllSchedulesQuery;
use App\Domain\Schedule\Queries\GetScheduleByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Schedule\Requests\CreateScheduleRequest;
use Domain\Schedule\Requests\UpdateScheduleRequest;

/**
 * Class ScheduleController
 * @package App\Http\Controllers\Admin
 */
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = $this->dispatch(new GetAllSchedulesQuery());

        return view('admin.schedules.index', [
            'schedules' => $schedules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateScheduleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateScheduleRequest $request)
    {
        $this->dispatch(new CreateScheduleCommand($request));

        return redirect(route('admin.schedules.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = $this->dispatch(new GetScheduleByIdQuery($id));

        return view('admin.schedules.edit', [
            'schedule' => $schedule
        ]);
    }

    /**
     * @param $id
     * @param UpdateScheduleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateScheduleRequest $request)
    {
        $this->dispatch(new UpdateScheduleCommand($id, $request));

        return redirect(route('admin.schedules.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteScheduleCommand($id));

        return redirect(route('admin.schedules.index'));
    }
}

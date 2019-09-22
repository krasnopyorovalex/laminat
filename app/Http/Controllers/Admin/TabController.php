<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Tab\Commands\CreateTabCommand;
use App\Domain\Tab\Commands\DeleteTabCommand;
use App\Domain\Tab\Commands\UpdateTabCommand;
use App\Domain\Tab\Queries\GetAllTabsQuery;
use App\Domain\Tab\Queries\GetTabByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Tab\Requests\CreateTabRequest;
use Domain\Tab\Requests\UpdateTabRequest;

/**
 * Class TabController
 * @package App\Http\Controllers\Admin
 */
class TabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabs = $this->dispatch(new GetAllTabsQuery());

        return view('admin.tabs.index', [
            'tabs' => $tabs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tabs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTabRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateTabRequest $request)
    {
        $this->dispatch(new CreateTabCommand($request));

        return redirect(route('admin.tabs.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tab = $this->dispatch(new GetTabByIdQuery($id));

        return view('admin.tabs.edit', [
            'tab' => $tab
        ]);
    }

    /**
     * @param $id
     * @param UpdateTabRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateTabRequest $request)
    {
        $this->dispatch(new UpdateTabCommand($id, $request));

        return redirect(route('admin.tabs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteTabCommand($id));

        return redirect(route('admin.tabs.index'));
    }
}

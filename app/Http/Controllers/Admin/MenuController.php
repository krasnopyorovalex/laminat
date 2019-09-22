<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Menu\Commands\CreateMenuCommand;
use App\Domain\Menu\Commands\DeleteMenuCommand;
use App\Domain\Menu\Commands\UpdateMenuCommand;
use App\Domain\Menu\Queries\GetAllMenusQuery;
use App\Domain\Menu\Queries\GetMenuByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Menu\Requests\CreateMenuRequest;
use Domain\Menu\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->dispatch(new GetAllMenusQuery());

        return view('admin.menus.index', [
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMenuRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateMenuRequest $request)
    {
        $this->dispatch(new CreateMenuCommand($request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->dispatch(new GetMenuByIdQuery($id));

        return view('admin.menus.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * @param $id
     * @param UpdateMenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $this->dispatch(new UpdateMenuCommand($id, $request));

        return redirect(route('admin.menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteMenuCommand($id));

        return redirect(route('admin.menus.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domain\MenuItem\Commands\CreateMenuItemCommand;
use App\Domain\MenuItem\Commands\DeleteMenuItemCommand;
use App\Domain\MenuItem\Commands\UpdateMenuItemCommand;
use App\Domain\MenuItem\Commands\UpdateMenuItemsPositionsCommand;
use App\Domain\MenuItem\Queries\GetAllMenuItemsQuery;
use App\Domain\MenuItem\Queries\GetMenuItemByIdQuery;
use App\Http\Controllers\Controller;
use Domain\MenuItem\Requests\CreateMenuItemRequest;
use Domain\MenuItem\Requests\UpdateMenuItemRequest;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * @param int $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $menu)
    {
        $menuItems = $this->dispatch(new GetAllMenuItemsQuery($menu, null));

        return view('admin.menu_items.index', [
            'menuItems' => $menuItems,
            'menu' => $menu
        ]);
    }

    /**
     * @param int $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(int $menu)
    {
        $menuItems = $this->dispatch(new GetAllMenuItemsQuery($menu, null));

        return view('admin.menu_items.create', [
            'menuItems' => $menuItems,
            'menu' => $menu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMenuItemRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateMenuItemRequest $request)
    {
        $this->dispatch(new CreateMenuItemCommand($request));

        return redirect(route('admin.menu_items.index', [
            'menu' => intval($request->get('menu_id'))
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $menuItem = $this->dispatch(new GetMenuItemByIdQuery($id));
        $menuItems = $this->dispatch(new GetAllMenuItemsQuery($menuItem->menu_id, $menuItem));

        return view('admin.menu_items.edit', [
            'menuItem' => $menuItem,
            'menuItems' => $menuItems
        ]);
    }

    /**
     * @param int $id
     * @param UpdateMenuItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, UpdateMenuItemRequest $request)
    {
        $this->dispatch(new UpdateMenuItemCommand($id, $request));
        $menuItem = $this->dispatch(new GetMenuItemByIdQuery($id));

        return redirect(route('admin.menu_items.index', [
            'menu' => $menuItem->menu_id
        ]));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id, Request $request)
    {
        $this->dispatch(new DeleteMenuItemCommand($id));

        return redirect(route('admin.menu_items.index', [
            'menu' => intval($request->post('menu_id'))
        ]));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function sorting(Request $request): array
    {
        $this->dispatch(new UpdateMenuItemsPositionsCommand($request));

        return [
            'status' => 'true'
        ];
    }
}

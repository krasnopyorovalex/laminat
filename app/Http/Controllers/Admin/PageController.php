<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Gallery\Queries\GetAllGalleriesQuery;
use App\Domain\Page\Commands\CreatePageCommand;
use App\Domain\Page\Commands\DeletePageCommand;
use App\Domain\Page\Commands\UpdatePageCommand;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Page\Queries\GetPageByIdQuery;
use App\Domain\Slider\Queries\GetAllSlidersQuery;
use App\Http\Controllers\Controller;
use App\Page;
use Domain\Page\Requests\CreatePageRequest;
use Domain\Page\Requests\UpdatePageRequest;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->dispatch(new GetAllPagesQuery);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new Page();
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $galleries = $this->dispatch(new GetAllGalleriesQuery());

        return view('admin.pages.create', [
            'templates' => $page->getTemplates(),
            'sliders' => $sliders,
            'galleries' => $galleries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreatePageRequest $request)
    {
        $this->dispatch(new CreatePageCommand($request));

        return redirect(route('admin.pages.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->dispatch(new GetPageByIdQuery($id));
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $galleries = $this->dispatch(new GetAllGalleriesQuery());

        return view('admin.pages.edit', [
            'page' => $page,
            'sliders' => $sliders,
            'galleries' => $galleries
        ]);
    }

    /**
     * @param $id
     * @param UpdatePageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdatePageRequest $request)
    {
        $this->dispatch(new UpdatePageCommand($id, $request));

        return redirect(route('admin.pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeletePageCommand($id));

        return redirect(route('admin.pages.index'));
    }
}

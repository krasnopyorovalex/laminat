<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Gallery\Commands\CreateGalleryCommand;
use App\Domain\Gallery\Commands\DeleteGalleryCommand;
use App\Domain\Gallery\Commands\UpdateGalleryCommand;
use App\Domain\Gallery\Queries\GetAllGalleriesQuery;
use App\Domain\Gallery\Queries\GetGalleryByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Gallery\Requests\CreateGalleryRequest;
use Domain\Gallery\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = $this->dispatch(new GetAllGalleriesQuery);

        return view('admin.galleries.index', [
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateGalleryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateGalleryRequest $request)
    {
        $this->dispatch(new CreateGalleryCommand($request));

        return redirect(route('admin.galleries.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = $this->dispatch(new GetGalleryByIdQuery($id));

        return view('admin.galleries.edit', [
            'gallery' => $gallery
        ]);
    }

    /**
     * @param $id
     * @param UpdateGalleryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateGalleryRequest $request)
    {
        $this->dispatch(new UpdateGalleryCommand($id, $request));

        return redirect(route('admin.galleries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteGalleryCommand($id));

        return redirect(route('admin.galleries.index'));
    }
}

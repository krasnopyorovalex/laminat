<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Redirect\Commands\CreateRedirectCommand;
use App\Domain\Redirect\Commands\DeleteRedirectCommand;
use App\Domain\Redirect\Commands\UpdateRedirectCommand;
use App\Domain\Redirect\Queries\GetAllRedirectsQuery;
use App\Domain\Redirect\Queries\GetRedirectByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Redirect\Requests\CreateRedirectRequest;
use Domain\Redirect\Requests\UpdateRedirectRequest;

/**
 * Class RedirectController
 * @package App\Http\Controllers\Admin
 */
class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirects = $this->dispatch(new GetAllRedirectsQuery);

        return view('admin.redirects.index', [
            'redirects' => $redirects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRedirectRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateRedirectRequest $request)
    {
        $this->dispatch(new CreateRedirectCommand($request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redirect = $this->dispatch(new GetRedirectByIdQuery($id));

        return view('admin.redirects.edit', [
            'redirect' => $redirect
        ]);
    }

    /**
     * @param $id
     * @param UpdateRedirectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRedirectRequest $request)
    {
        $this->dispatch(new UpdateRedirectCommand($id, $request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteRedirectCommand($id));

        return redirect(route('admin.redirects.index'));
    }
}

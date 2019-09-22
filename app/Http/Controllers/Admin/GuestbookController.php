<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Guestbook\Commands\CreateGuestbookCommand;
use App\Domain\Guestbook\Commands\DeleteGuestbookCommand;
use App\Domain\Guestbook\Commands\UpdateGuestbookCommand;
use App\Domain\Guestbook\Queries\GetAllGuestbookQuery;
use App\Domain\Guestbook\Queries\GetGuestbookByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Guestbook\Requests\CreateGuestbookRequest;
use Domain\Guestbook\Requests\UpdateGuestbookRequest;

/**
 * Class GuestbookController
 * @package App\Http\Controllers\Admin
 */
class GuestbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guestbooks = $this->dispatch(new GetAllGuestbookQuery());

        return view('admin.guestbooks.index', [
            'guestbooks' => $guestbooks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guestbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateGuestbookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateGuestbookRequest $request)
    {
        $this->dispatch(new CreateGuestbookCommand($request));

        return redirect(route('admin.guestbooks.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guestbook = $this->dispatch(new GetGuestbookByIdQuery($id));

        return view('admin.guestbooks.edit', [
            'guestbook' => $guestbook
        ]);
    }

    /**
     * @param $id
     * @param UpdateGuestbookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateGuestbookRequest $request)
    {
        $this->dispatch(new UpdateGuestbookCommand($id, $request));

        return redirect(route('admin.guestbooks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteGuestbookCommand($id));

        return redirect(route('admin.guestbooks.index'));
    }
}

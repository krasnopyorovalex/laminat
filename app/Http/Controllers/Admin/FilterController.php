<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Filter\Commands\CreateFilterCommand;
use App\Domain\Filter\Commands\DeleteFilterCommand;
use App\Domain\Filter\Commands\UpdateFilterCommand;
use App\Domain\Filter\Queries\GetAllFiltersQuery;
use App\Domain\Filter\Queries\GetFilterByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Filter\Requests\CreateFilterRequest;
use Domain\Filter\Requests\UpdateFilterRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class FilterController
 * @package App\Http\Controllers\Admin
 */
class FilterController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $filters = $this->dispatch(new GetAllFiltersQuery());

        return view('admin.filters.index', [
            'filters' => $filters
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.filters.create');
    }

    /**
     * @param CreateFilterRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateFilterRequest $request)
    {
        $this->dispatch(new CreateFilterCommand($request));

        return redirect(route('admin.filters.index'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $filter = $this->dispatch(new GetFilterByIdQuery($id));

        return view('admin.filters.edit', [
            'filter' => $filter
        ]);
    }

    /**
     * @param $id
     * @param UpdateFilterRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, UpdateFilterRequest $request)
    {
        $this->dispatch(new UpdateFilterCommand($id, $request));

        return redirect(route('admin.filters.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteFilterCommand($id));

        return redirect(route('admin.filters.index'));
    }
}

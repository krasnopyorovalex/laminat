<?php

namespace App\Http\Controllers\Admin;

use App\Filter;
use App\Domain\FilterOption\Commands\CreateFilterOptionCommand;
use App\Domain\FilterOption\Commands\DeleteFilterOptionCommand;
use App\Domain\FilterOption\Commands\UpdateFilterOptionCommand;
use App\Domain\FilterOption\Queries\GetAllFilterOptionsQuery;
use App\Domain\FilterOption\Queries\GetFilterOptionByIdQuery;
use App\Http\Controllers\Controller;
use Domain\FilterOption\Requests\CreateFilterOptionRequest;
use Domain\FilterOption\Requests\UpdateFilterOptionRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

/**
 * Class filterOptionController
 * @package App\Http\Controllers\Admin
 */
class FilterOptionController extends Controller
{
    /**
     * @param int $filter
     * @return Factory|View
     */
    public function index(int $filter)
    {
        $filterOptions = $this->dispatch(new GetAllFilterOptionsQuery($filter));

        return view('admin.filter_options.index', [
            'filterOptions' => $filterOptions,
            'filter' => $filter
        ]);
    }

    /**
     * @param Filter $filter
     * @return Factory|View
     */
    public function create(Filter $filter)
    {
        return view('admin.filter_options.create', [
            'filter' => $filter
        ]);
    }

    /**
     * @param CreatefilterOptionRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatefilterOptionRequest $request)
    {
        $this->dispatch(new CreateFilterOptionCommand($request));

        return redirect(route('admin.filter_options.index',[
            'filter' => (int) $request->post('filter_id')
        ]));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $filterOption = $this->dispatch(new GetFilterOptionByIdQuery($id));

        return view('admin.filter_options.edit', [
            'filterOption' => $filterOption
        ]);
    }

    /**
     * @param $id
     * @param UpdatefilterOptionRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, UpdatefilterOptionRequest $request)
    {
        $this->dispatch(new UpdatefilterOptionCommand($id, $request));
        $filterOption = $this->dispatch(new GetfilterOptionByIdQuery($id));

        return redirect(route('admin.filter_options.index', [
            'filter' => $filterOption->filter->id
        ]));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function destroy($id, Request $request)
    {
        $this->dispatch(new DeletefilterOptionCommand($id));

        return redirect(route('admin.filter_options.index', [
            'filter' => (int) $request->post('filter_id')
        ]));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Catalog\Commands\CreateCatalogCommand;
use App\Domain\Catalog\Commands\DeleteCatalogCommand;
use App\Domain\Catalog\Commands\UpdateCatalogCommand;
use App\Domain\Catalog\Queries\GetAllCatalogsNotParentQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\Catalog\Queries\GetCatalogByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\TreeRecursiveBuildService;
use Domain\Catalog\Requests\CreateCatalogRequest;
use Domain\Catalog\Requests\UpdateCatalogRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * @property  treeRecursiveBuildService
 */
class CatalogController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsNotParentQuery());

        return view('admin.catalogs.index', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsQuery());

        return view('admin.catalogs.create', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @param CreateCatalogRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCatalogRequest $request)
    {
        $this->dispatch(new CreateCatalogCommand($request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $catalog = $this->dispatch(new GetCatalogByIdQuery($id));
        $catalogs = $this->dispatch(new GetAllCatalogsQuery($catalog));

        return view('admin.catalogs.edit', [
            'catalog' => $catalog,
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @param $id
     * @param UpdateCatalogRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update($id, UpdateCatalogRequest $request)
    {
        $this->dispatch(new UpdateCatalogCommand($id, $request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteCatalogCommand($id));

        return redirect(route('admin.catalogs.index'));
    }
}

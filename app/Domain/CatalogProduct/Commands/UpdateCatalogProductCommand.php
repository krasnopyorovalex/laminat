<?php

namespace App\Domain\CatalogProduct\Commands;

use App\CatalogProduct;
use App\CatalogProductFilter;
use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateCatalogProductCommand
 * @package App\Domain\CatalogProduct\Commands
 */
class UpdateCatalogProductCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateCatalogCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $catalogProduct = $this->dispatch(new GetCatalogProductByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($catalogProduct->getOriginal('alias') !== $urlNew) {
            event(new RedirectDetected($catalogProduct->getOriginal('alias'), str_slug($urlNew), 'catalog_product.show'));
        }

        if ($this->request->has('image')) {
            if ($catalogProduct->image) {
                $this->dispatch(new DeleteImageCommand($catalogProduct->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $catalogProduct->id, CatalogProduct::class));
        }

        $this->syncCatalogProductFilters();

        return $catalogProduct->update($this->request->all());
    }

    private function syncCatalogProductFilters(): void
    {
        if ($this->request->post('filters')) {

            CatalogProductFilter::where('catalog_product_id', $this->id)->delete();

            foreach ($this->request->post('filters') as $filter => $filterOption) {
                if ($filterOption) {
                    CatalogProductFilter::create([
                        'catalog_product_id' => $this->id,
                        'filter_id' => (int)$filter,
                        'filter_option_id' => (int)$filterOption
                    ]);
                }
            }
        }
    }
}

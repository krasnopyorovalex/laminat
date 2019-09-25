<?php

namespace App\Domain\CatalogProduct\Commands;

use App\CatalogProductFilter;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\CatalogProduct;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateCatalogProductCommand
 * @package App\Domain\CatalogProduct\Commands
 */
class CreateCatalogProductCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateCatalogCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $catalogProduct = new CatalogProduct();
        $catalogProduct->fill($this->request->all());

        $catalogProduct->save();

        $this->syncCatalogProductFilters($catalogProduct);

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $catalogProduct->id, CatalogProduct::class));
        }

        return true;
    }

    /**
     * @param CatalogProduct $catalogProduct
     */
    private function syncCatalogProductFilters(CatalogProduct $catalogProduct): void
    {
        if ($this->request->post('filters')) {
            foreach ($this->request->post('filters') as $filter => $filterOption) {
                if ($filterOption) {
                    CatalogProductFilter::create([
                        'catalog_product_id' => $catalogProduct->id,
                        'filter_id' => (int)$filter,
                        'filter_option_id' => (int)$filterOption
                    ]);
                }
            }
        }
    }
}

<?php

namespace App\Domain\CatalogProduct\Commands;

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

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $catalogProduct->id, CatalogProduct::class));
        }

        return true;
    }
}

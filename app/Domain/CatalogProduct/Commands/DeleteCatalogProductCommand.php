<?php

namespace App\Domain\CatalogProduct\Commands;

use App\Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteCatalogProductCommand
 * @package App\Domain\CatalogProduct\Commands
 */
class DeleteCatalogProductCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteCatalogCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $catalogProduct = $this->dispatch(new GetCatalogProductByIdQuery($this->id));


        if($catalogProduct->image) {
            $this->dispatch(new DeleteImageCommand($catalogProduct->image));
        }

        return $catalogProduct->delete();
    }
}

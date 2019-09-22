<?php

namespace App\Domain\Page\Commands;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Page\Queries\GetPageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeletePageCommand
 * @package App\Domain\Page\Commands
 */
class DeletePageCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeletePageCommand constructor.
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
        $page = $this->dispatch(new GetPageByIdQuery($this->id));

        if($page->image) {
            $this->dispatch(new DeleteImageCommand($page->image));
        }

        return $page->delete();
    }

}
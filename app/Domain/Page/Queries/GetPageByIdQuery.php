<?php

namespace App\Domain\Page\Queries;

use App\Page;

/**
 * Class GetPageByIdQuery
 * @package App\Domain\Page\Queries
 */
class GetPageByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetPageByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Page::with(['image'])->findOrFail($this->id);
    }
}
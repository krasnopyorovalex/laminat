<?php

namespace App\Domain\Article\Queries;

use App\Article;

/**
 * Class GetArticleByIdQuery
 * @package App\Domain\Article\Queries
 */
class GetArticleByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetArticleByIdQuery constructor.
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
        return Article::with(['image'])->findOrFail($this->id);
    }
}
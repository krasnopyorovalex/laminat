<?php

namespace App\Domain\Article\Queries;

use App\Article;

/**
 * Class GetArticleByAliasQuery
 * @package App\Domain\Article\Queries
 */
class GetArticleByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetArticleByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Article::with(['image'])->where('alias', $this->alias)->firstOrFail();
    }
}
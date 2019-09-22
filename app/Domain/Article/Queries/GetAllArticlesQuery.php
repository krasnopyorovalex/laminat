<?php

namespace App\Domain\Article\Queries;

use App\Article;

/**
 * Class GetAllArticlesQuery
 * @package App\Domain\Article\Queries
 */
class GetAllArticlesQuery
{
    /**
     * @var bool
     */
    private $isPublished;

    /**
     * @var int
     */
    private $limit;

    /**
     * GetAllArticlesQuery constructor.
     * @param bool $isPublished
     * @param int $limit
     */
    public function __construct(bool $isPublished = false, int $limit = 0)
    {
        $this->isPublished = $isPublished;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $articles = new Article();
        $articles = $articles->orderBy('published_at', 'desc');

        if ($this->isPublished) {
           $articles->where('is_published', '1');
        }

        if ($this->limit) {
            return $articles->paginate($this->limit, array('*'), 'page', intval(request('page')));
        }

        return $articles->get();
    }
}

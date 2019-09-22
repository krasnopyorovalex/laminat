<?php

namespace App\Domain\Article\DTO;

use App\Article;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdjoiningResult
 * @package App\Domain\Article\DTO
 */
class AdjoiningResult
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * AdjoiningResult constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function nextOrFirst(Article $article)
    {
        if ($this->collection->count() < 3) {
            return false;
        }
        return $this->collection->first(function ($value, $key) use ($article) {
            return $value->published_at < $article->published_at;
        }) ?: $this->collection->first();
    }

    /**
     * @param Article $article
     * @return mixed
     */
    public function prevOrLast(Article $article)
    {
        if ($this->collection->count() < 3) {
            return false;
        }
        return $this->collection->last(function ($value, $key) use ($article) {
            return $value->published_at > $article->published_at;
        }) ?: $this->collection->last();
    }
}
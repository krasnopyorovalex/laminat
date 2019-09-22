<?php

namespace App\Http\ViewComposers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ArticleComposer
 * @package App\Http\ViewComposers
 */
class ArticleComposer
{
    use DispatchesJobs;

    private const PAGINATE_LIMIT = 10;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $articles = $this->dispatch(new GetAllArticlesQuery(true, self::PAGINATE_LIMIT));

        $view->with('articles', $articles);
    }
}
<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetArticleByAliasQuery;
use App\Domain\Article\Queries\GetAdjoiningArticleQuery;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $alias)
    {
        $article = $this->dispatch(new GetArticleByAliasQuery($alias));
        $adjoiningArticles = $this->dispatch(new GetAdjoiningArticleQuery());

        return view('article.index', [
            'article' => $article,
            'next' => $adjoiningArticles->nextOrFirst($article),
            'prev' => $adjoiningArticles->prevOrLast($article)
        ]);
    }
}
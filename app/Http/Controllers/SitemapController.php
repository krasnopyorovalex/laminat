<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use Illuminate\Http\Response;

/**
 * Class SitemapController
 * @package App\Http\Controllers
 */
class SitemapController extends Controller
{
    /**
     * @return Response
     */
    public function xml()
    {
        $pages = $this->dispatch(new GetAllPagesQuery());
        $articles = $this->dispatch(new GetAllArticlesQuery(true));

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles
            ])
            ->header('Content-Type', 'text/xml');
    }
}

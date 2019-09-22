<?php

namespace App\Http\Controllers;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use App\Domain\Service\Queries\GetAllServicesQuery;

/**
 * Class SitemapController
 * @package App\Http\Controllers
 */
class SitemapController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function xml()
    {
        $pages = $this->dispatch(new GetAllPagesQuery());
        $services = $this->dispatch(new GetAllServicesQuery());
        $articles = $this->dispatch(new GetAllArticlesQuery(true));

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles,
                'services' => $services
            ], 200)
            ->header('Content-Type', 'text/xml');
    }
}

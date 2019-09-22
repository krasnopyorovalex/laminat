<?php

namespace App\Http\Middleware;

use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Catalog\Queries\GetAllCatalogsQuery;
use App\Domain\Page\Queries\GetAllPagesQuery;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ShortCodeMiddleware
{
    use DispatchesJobs;

    /**
     * @param $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next): Response
    {
        /** @var $response Response */
        $response = $next($request);

        if ( ! method_exists($response, 'content')) {
            return $response;
        }

        $content = preg_replace_callback_array(
            [
                '#(<p(.*)>)?{sitemap}(<\/p>)?#' => function () {
                    $pages = $this->dispatch(new GetAllPagesQuery());
                    $articles = $this->dispatch(new GetAllArticlesQuery(true));
                    $catalog = $this->dispatch(new GetAllCatalogsQuery());

                    return view('layouts.shortcodes.sitemap', [
                        'pages' => $pages,
                        'articles' => $articles,
                        'catalog' => $catalog
                    ]);
                }
            ],
            $response->content()
        );

        $response->setContent($content);

        return $response;
    }
}

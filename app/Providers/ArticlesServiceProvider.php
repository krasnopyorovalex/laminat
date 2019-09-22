<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ArticlesServiceProvider
 * @package App\Providers
 */
class ArticlesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('view')->composer(['page.blog'], 'App\Http\ViewComposers\ArticleComposer');
    }
}

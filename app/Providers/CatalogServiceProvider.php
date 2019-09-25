<?php

namespace App\Providers;

use App\Http\ViewComposers\CatalogComposer;
use Illuminate\Support\ServiceProvider;

/**
 * Class CatalogServiceProvider
 * @package App\Providers
 */
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['layouts.sections.catalog', 'layouts.partials.categories_menu'], CatalogComposer::class);
    }
}

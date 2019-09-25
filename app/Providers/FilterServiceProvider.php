<?php

namespace App\Providers;

use App\Http\ViewComposers\FilterComposer;
use Illuminate\Support\ServiceProvider;

/**
 * Class FilterServiceProvider
 * @package App\Providers
 */
class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['layouts.sections.filter_panel'], FilterComposer::class);
    }
}

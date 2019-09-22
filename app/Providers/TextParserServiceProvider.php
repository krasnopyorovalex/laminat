<?php

namespace App\Providers;

use App\Services\TextParserService;
use Illuminate\Support\ServiceProvider;

class TextParserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TextParserService::class, function () {
            return new TextParserService();
        });
    }
}

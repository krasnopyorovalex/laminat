<?php

namespace App\Providers;

use App\Services\LinkGeneratorService;
use Illuminate\Support\ServiceProvider;

class LinkGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkGeneratorService::class, function () {
            return new LinkGeneratorService();
        });
    }
}

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
    public function register(): void
    {
        $this->app->bind(LinkGeneratorService::class, static function () {
            return new LinkGeneratorService();
        });
    }
}

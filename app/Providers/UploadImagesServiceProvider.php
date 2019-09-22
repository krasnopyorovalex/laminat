<?php

namespace App\Providers;

use App\Services\UploadImagesService;
use Illuminate\Support\ServiceProvider;

class UploadImagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadImagesService::class, function () {
            return new UploadImagesService();
        });
    }
}

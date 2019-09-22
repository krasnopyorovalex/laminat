<?php

namespace App\Providers;

use App\Services\UploadCkeditorImageService;
use Illuminate\Support\ServiceProvider;

class UploadCkeditorImageServiceProvider extends ServiceProvider
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
        $this->app->bind(UploadCkeditorImageService::class, function () {
            return new UploadCkeditorImageService();
        });
    }
}

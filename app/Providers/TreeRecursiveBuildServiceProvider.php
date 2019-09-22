<?php

namespace App\Providers;

use App\Services\TreeRecursiveBuildService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TreeRecursiveBuildServiceProvider
 * @package App\Providers
 */
class TreeRecursiveBuildServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TreeRecursiveBuildService::class, function () {
            return new TreeRecursiveBuildService();
        });
    }
}

<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('includes.input', 'input');
        Blade::include('includes.submit_btn', 'submit_btn');
        Blade::include('includes.textarea', 'textarea');
        Blade::include('includes.checkbox', 'checkbox');
        Blade::include('includes.imageInput', 'imageInput');
        Blade::include('includes.dateInput', 'dateInput');
        Blade::include('includes.selectLink', 'selectLink');
        Blade::include('includes.select', 'select');

        setlocale(LC_TIME, 'ru_RU.UTF-8');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

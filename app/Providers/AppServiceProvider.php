<?php

namespace App\Providers;

use App\Breadcrumbs\Breadcrumbs;
use App\View\Components\navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('navbar');

        Blade::component('navbar',navbar::class);
        Request::macro('breadcrumbs', function () {
            return new Breadcrumbs($this);
        });
    }
}

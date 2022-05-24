<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\TranslationLoader\LanguageLine;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', 'App\Http\View\Composers\LanguageComposer');
        View::composer('*', 'App\Http\View\Composers\SettingComposer');
        View::composer('*', 'App\Http\View\Composers\PageComposer');

        View::composer('*',function ($view){
            $langs = app(LanguageLine::class)->getTranslationsForGroup(app()->getLocale(),'client');

            $view->with('client_translation',$langs);
        });
    }
}

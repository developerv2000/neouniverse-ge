<?php

namespace App\Providers;

use App\Models\Carousel;
use App\Models\Locale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $view->with('locale', App::currentLocale() )
                ->with('localedValue', App::currentLocale() . '_value' );
        }); 

        View::composer(['layouts.app', 'dashboard.layouts.app'], function ($view) {
            $view->with('route', Route::currentRouteName());
        });

        View::composer('components.main-carousel', function ($view) {
            $view->with('carouselItems', Carousel::inRandomOrder()->get());
        });

        View::composer('layouts.header', function ($view) {
            $view->with('locales', Locale::where('visibility', true)->get());
        });
    }
}

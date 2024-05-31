<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
        if (app()->environment('local')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class,);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // the quiery won't be triggered until the view is loaded
        View::composer('*', function ($view) {
            $channels = Cache::rememberForever('channels', function () {
                return Channel::all();
            });

            $view->with('channels', $channels);
        });

        Paginator::useBootstrapFive();
    }
}

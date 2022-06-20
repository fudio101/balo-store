<?php

namespace App\Providers;

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
    final public function boot()
    {
        View::composer(['errors::404'], static function ($view) {
            $view->with([
                'title' => '404 - Not Found',
                'secondTitle' => 'Something went wrong',
            ]);
        });
    }
}

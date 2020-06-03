<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
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
        // You can define your own "echo format" that will be used with the regular content tags
        \Blade::setEchoFormat('nl2br(e(%s))');
        Schema::defaultStringLength(191);
    }
}

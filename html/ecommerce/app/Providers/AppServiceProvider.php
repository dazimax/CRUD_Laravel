<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\LogEntriesHandler;
use Log;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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

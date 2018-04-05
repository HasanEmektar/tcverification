<?php


namespace HasanEmektar\tc;

use Illuminate\Support\ServiceProvider;

class TCverificationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TCverification::class, function () {
            return new TCverification();
        });

        $this->app->alias(TCverification::class, 'tcverification');
    }
}

<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugBarServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength(191);
	    \Validator::extend('snils', 'App\Validators\SNILSValidator@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() === 'local'){
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DebugBarServiceProvider::class);
        }
    }
}

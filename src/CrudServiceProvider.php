<?php

namespace Noman\Easycrud;
use Illuminate\Support\ServiceProvider;


class CrudServiceProvider extends ServiceProvider{

    public function boot()
    {
           $this->loadRoutesFrom(__DIR__.'/routes/web.php');
           $this->loadViewsFrom(__DIR__.'/resources','easycrud');

           $this->publishes([
                __DIR__.'/assets' => public_path('easycrud/assets'),
            ], 'public');
            $this->publishes([
                __DIR__ . 'migrations/' => database_path('migrations'),
            ], 'easycrud-migrations');
    }

    public function register()
    {

    }
}
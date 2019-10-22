<?php

namespace App\Providers;

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
        $this->app->bind('Http\Client', function($app, $options) {
            return new \GuzzleHttp\Client($options);
        });
        $this->app->bind('Service\Pokemon', function ($app) {
            return new \App\Services\PokemonService(
                $app->makeWith('Http\Client', ['base_uri'=>env('POKEAPI_URL'),'verify'=>false])
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

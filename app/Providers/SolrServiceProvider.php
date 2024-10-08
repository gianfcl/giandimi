<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;

class SolrServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return  void
     */

    public function boot(){
        //dd();
    }

    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client($app['config']['solarium']);
        });
    }

    public function provides()
    {
        return [Client::class];
    }
}
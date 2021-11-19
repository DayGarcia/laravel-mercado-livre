<?php

namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Support\ServiceProvider;
use DayGarcia\LaravelMercadoLivre\MercadoLivre;

class MercadoLivreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    public function register()
    {
        $this->app->singleton('mercadolivre', function () {
            return new MercadoLivre();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/mercadolivre.php' => config_path('mercadolivre.php'),
        ]);

        $this->client_id = config('mercadolivre.client_id');
        $this->client_secret = config('mercadolivre.client_secret');
        $this->urls = config('mercadolivre.urls');
    }
}

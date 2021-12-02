<?php

namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Support\ServiceProvider;
use DayGarcia\LaravelMercadoLivre\MercadoLivre;
use Illuminate\Support\Facades\Storage;

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
        // check if the App/Http/Requests/LaravelMercadoLivreExists directory exists
        if (!file_exists(app_path('Http/Requests/LaravelMercadoLivre/'))) {
            mkdir(app_path('Http/Requests/LaravelMercadoLivre/'), 0755, true);
        }
        $this->publishes([
            __DIR__ . '/app/Http/Requests/' => app_path('Http/Requests/LaravelMercadoLivre/'),
        ]);

        $this->client_id = config('mercadolivre.client_id');
        $this->client_secret = config('mercadolivre.client_secret');
        $this->urls = config('mercadolivre.urls');
    }
}

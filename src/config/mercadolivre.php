<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Keys      
    |--------------------------------------------------------------------------
    |
    | 
    | Amazon API docs.:
    | https://developers.mercadolibre.com/
    |
    */

    'client_id'     => env('MELI_APP_ID'),
    'client_secret' => env('MELI_CLIENT_SECRET'),

    'urls' => [
        'api_url'      => 'https://api.mercadolibre.com',
        'auth_url'     => 'https://auth.mercadolivre.com.br/authorization',
        'oauth_url'    => '/oauth/token'
    ],
];

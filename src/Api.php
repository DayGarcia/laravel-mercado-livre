<?php

namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Support\Facades\Http;

class Api
{
    private const url = 'https://api.mercadolibre.com/';

    public function get(String $access_token, String $url, array $params = [])
    {
        $response = Http::withToken($access_token)->get(self::url . $url, $params);
        return $response->json();
    }

    public function post($url, $params = [])
    {
        $response = Http::post($url, $params);
        return $response->json();
    }
}

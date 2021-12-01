<?php

namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use stdClass;

class Api
{
    private const url = 'https://api.mercadolibre.com/';

    public function get(String $access_token, String $url)
    {
        return Http::withToken($access_token)->get(self::url . $url)->object();
    }

    public function post($url, $params = [])
    {
        return Http::post($url, $params)->object();
    }
}

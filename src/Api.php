<?php

namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class Api
{
    private const url = 'https://api.mercadolibre.com/';

    public function get(String $access_token, String $url, array $params = []): JsonResponse
    {
        return Http::withToken($access_token)->get(self::url . $url, $params)->object();
    }

    public function post($url, $params = [])
    {
        return Http::post($url, $params)->object();
    }
}

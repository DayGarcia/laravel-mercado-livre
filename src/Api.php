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

    public function post(string $access_token, $url, $data)
    {
        return Http::withToken($access_token)->post(self::url . $url, $data)->object();
    }

    public function put(string $access_token, $url, $data)
    {
        return Http::withToken($access_token)->put(self::url . $url, $data)->object();
    }

    public function delete(string $access_token, $url)
    {
        return Http::withToken($access_token)->delete(self::url . $url)->object();
    }

    public function upload(string $access_token, $url, $file)
    {
        return Http::withToken($access_token)->attach(
            'attachment',
            file_get_contents($file),
        )->post(self::url . $url)->object();
    }
}

<?php

/**
 * MercadoLivre
 *
 * @author Ives Samuel
 * @author Day Garcia
 */

namespace DayGarcia\LaravelMercadoLivre;

use DayGarcia\LaravelMercadoLivre\Contracts;
use Illuminate\Support\Facades\Http;


class MercadoLivre implements Contracts
{
    private const curl_opts = [
        CURLOPT_USERAGENT       => "MELI-PHP-SDK-1.1.0",
        CURLOPT_SSL_VERIFYPEER  => true,
        CURLOPT_CONNECTTIMEOUT  => 10,
        CURLOPT_RETURNTRANSFER  => 1,
        CURLOPT_TIMEOUT         => 60
    ];

    private const URL = 'https://api.mercadolibre.com/';
    private const REDIRECT = 'common/mercadolivre';

    public static function get(array $config)
    {
        $response = Http::withHeaders("Authorization: Bearer {$config['token']}")->get($config['route'])->object();
        if (isset($response['invoice_number'])) {
            if (isset($response['errors'])) {
                return array(
                    'error' => $response['errors']
                );
            } else {
                return $response;
            }
        } else {
            return $response;
        }
    }

    public static function getPDF(array $config)
    {
        return Http::withHeaders("Authorization: Bearer {$config['token']}")->get($config['route'])->object();
    }

    public static function add(array $config)
    {
        $response = Http::withHeaders("Authorization: Bearer {$config['token']}")->post($config['route'], $config['data'])->object();

        if ($response) {
            if (isset($response['errors'])) {
                return array(
                    'error' => $response['errors']
                );
            } else {
                return $response;
            }
        } else {
            return $response;
        }
    }

    public static function update(array $config)
    {
        $response = Http::withHeaders("Authorization: Bearer {$config['token']}")->post($config['route'], $config['data'])->object();

        if ($response) {
            if (isset($response['errors'])) {
                return array(
                    'error' => $response['errors']
                );
            } else {
                return $response;
            }
        } else {
            return $response;
        }
    }
}

<?php

/**
 * MercadoLivre
 *
 * @author Ives Samuel
 * @author Day Garcia
 */

namespace DayGarcia\LaravelMercadoLivre;

use DayGarcia\MercadoLivre\Contracts;
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

    public function __construct()
    {
        //
    }

    public function authorize(array $params)
    {
        $url_redirect = self::REDIRECT;

        $authorization_type = array(
            'renew' => array(
                'body'  => http_build_query([
                    'grant_type'    => 'refresh_token',
                    'client_id'     => config('mercadolivre.client_id'),
                    'client_secret' => config('mercadolivre.client_secret'),
                    'refresh_token' => $params['token']
                ])
            ),
            'new'   => array(
                'body'  => http_build_query([
                    'grant_type'        => 'authorization_code',
                    'client_id'         => config('mercadolivre.client_id'),
                    'client_secret'     => config('mercadolivre.client_secret'),
                    'code'              => $params['code'],
                    'redirect_uri'      => config('app.url') . $url_redirect
                ])
            )
        );

        $response = Http::withHeaders(
            [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: application/json'
            ]
        )->post(
            self::URL . $params['route'],
            $authorization_type[$params['type']['body']]
        )->object();

        if (isset($response['refresh_token'])) {
            return array(
                'token'     => $response['access_token'],
                'refresh'   => $response['refresh_token']
            );
        } else if (isset($response['access_token'])) {
            return array(
                'token' => $response['access_token']
            );
        } else {
            return array(
                'error'     => $response['error'],
                'message'   => $response['message']
            );
        }
    }

    public static function get(array $params)
    {
        $response = Http::withHeaders("Authorization: Bearer {$params['token']}")->get($params['route'])->object();
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

    public static function getPDF(array $params)
    {
        return Http::withHeaders("Authorization: Bearer {$params['token']}")->get($params['route'])->object();
    }

    public static function add(array $params)
    {
        $response = Http::withHeaders("Authorization: Bearer {$params['token']}")->post($params['route'], $params['data'])->object();

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

    public static function update(array $params)
    {
        $response = Http::withHeaders("Authorization: Bearer {$params['token']}")->post($params['route'], $params['data'])->object();

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

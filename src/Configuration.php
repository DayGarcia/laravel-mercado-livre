<?php


namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Support\Facades\Http;

class Configuration
{
    private const URL = 'https://api.mercadolibre.com/';
    private const REDIRECT = 'common/mercadolivre';

    private $code;
    private $client_id;
    private $secret;
    private $redirect;

    public function __construct(String $code, String $client_id, String $secret, String $redirect, String $token = null)
    {
        $this->code = $code;
        $this->code = $client_id;
        $this->secret = $secret;
        $this->redirect = $redirect;
        $this->token = $token;
    }

    public function authorize(array $params)
    {
        $authorization_type = array(
            'renew' => array(
                'body'  => http_build_query([
                    'grant_type'    => 'refresh_token',
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->secret,
                    'refresh_token' => $this->token
                ])
            ),
            'new'   => array(
                'body'  => http_build_query([
                    'grant_type'        => 'authorization_code',
                    'client_id'         => $this->client_id,
                    'client_secret'     => $this->secret,
                    'code'              => $this->code,
                    'redirect_uri'      => config('app.url') . self::REDIRECT
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
}

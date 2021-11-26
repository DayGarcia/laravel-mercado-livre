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
    private $access_token;
    private $refresh_token;
    private $type;
    private $route;
    private $errors = [];

    public function __construct(String $code, String $client_id, String $secret, String $redirect, String $type, String $route, String $refresh_token = null)
    {
        $this->code = $code;
        $this->client_id = $client_id;
        $this->secret = $secret;
        $this->redirect = $redirect;
        $this->refresh_token = $refresh_token;
        $this->type = $type;
        $this->route = $route;

        $this->authorize();
    }

    public function authorize(): void
    {
        $authorization_type = array(
            'renew' => array(
                'body'  => http_build_query([
                    'grant_type'    => 'refresh_token',
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->secret,
                    'refresh_token' => $this->refresh_token
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
        // dd($authorization_type['renew']['body']);
        $response = Http::withHeaders(
            [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: application/json'
            ]
        )->post(
            self::URL . $this->route,

        )->object();

        dd($response);

        if (isset($response['refresh_token'])) {
            $this->setAccessToken($response['access_token']);
            $this->setRefreshToken($response['refresh_token']);
        } else if (isset($response['access_token'])) {
            $this->setAccessToken($response['access_token']);
        } else {
            $this->setErrors([$response['error'], $response['message']]);
        }
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }

    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

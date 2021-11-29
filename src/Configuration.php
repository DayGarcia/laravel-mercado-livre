<?php


namespace DayGarcia\LaravelMercadoLivre;

use Illuminate\Support\Facades\Http;

class Configuration
{
    private const URL = 'https://api.mercadolibre.com/';

    private $code;
    private $client_id;
    private $secret;
    private $access_token;
    private $refresh_token;
    private $type;
    private $redirect_uri;
    private $user_id;
    private $errors = [];

    public function __construct(String $code, String $client_id, String $secret, String $redirect_uri, String $type, String $refresh_token = null)
    {
        $this->code = $code;
        $this->client_id = $client_id;
        $this->secret = $secret;
        $this->redirect_uri = $redirect_uri;
        $this->refresh_token = $refresh_token;
        $this->type = $type;

        $this->authorize();
    }

    public function authorize(): void
    {
        $authorization_type = array(
            'renew' => array(
                'body'  => [
                    'grant_type'    => 'refresh_token',
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->secret,
                    'refresh_token' => $this->refresh_token
                ]
            ),
            'new'   => array(
                'body'  => [
                    'grant_type'        => 'authorization_code',
                    'client_id'         => $this->client_id,
                    'client_secret'     => $this->secret,
                    'code'              => $this->code,
                    'redirect_uri'      => $this->redirect_uri
                ]
            )
        );

        $response = Http::withHeaders(
            [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: application/json'
            ]
        )->post(
            self::URL . '/oauth/token',
            $authorization_type[$this->type]['body']
        )->object();

        if (isset($response->refresh_token)) {
            $this->setAccessToken($response->access_token);
            $this->setRefreshToken($response->refresh_token);
        } else if (isset($response->access_token)) {
            $this->setAccessToken($response->access_token);
            $this->setUserId($response->user_id);
        } else {
            $this->setErrors([$response->error, $response->message]);
            $this->setErrorCode($response->status);
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

    public function setUserId(float $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): float
    {
        return $this->user_id;
    }

    public function setErrorCode(float $error_code): void
    {
        $this->error_code = $error_code;
    }

    public function getErrorCode(): float
    {
        return $this->error_code;
    }
}

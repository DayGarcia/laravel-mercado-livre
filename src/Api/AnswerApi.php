<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class AnswerApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function createAnswer(array $data)
    {
        $url = 'answers';
        $response = $this->post($this->configuration->getAccessToken(), $url, $data);

        return $response->json();
    }
}

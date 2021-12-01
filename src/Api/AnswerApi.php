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
        return $this->post($this->configuration->getAccessToken(), $url, $data);
    }
}

<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class ImageApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function uploadImage($file)
    {
        $url = 'pictures';
        return $this->post($this->configuration->getAccessToken(), $url, $file);
    }
}

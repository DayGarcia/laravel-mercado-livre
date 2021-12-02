<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class PictureApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function uploadPicture($file)
    {
        $url = 'pictures';
        return $this->upload($this->configuration->getAccessToken(), $url, $file);
    }
}

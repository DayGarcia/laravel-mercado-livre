<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class SearchApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getSearch(string $category = '', string $q = '', string $nickname = '', string $seller_id = '')
    {
        $url = 'sites/' . config('mercadolivre.site_id') . "/search?category={$category}&q={$q}&nickname={$nickname}&seller_id={$seller_id}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }
}

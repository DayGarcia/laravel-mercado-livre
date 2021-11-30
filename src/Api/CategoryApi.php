<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class CategoryApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getCategories()
    {
        $url = 'sites/' . config('mercadolivre.site_id') . '/categories';
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getCategory(String $categoryId)
    {
        $url = "categories/{$categoryId}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getCategoryAttributes(String $categoryId)
    {
        $url = "categories/{$categoryId}/attributes";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }
}

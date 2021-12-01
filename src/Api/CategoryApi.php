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
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getCategory(String $categoryId)
    {
        $url = "categories/{$categoryId}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getCategoryAttributes(String $categoryId)
    {
        $url = "categories/{$categoryId}/attributes";
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}

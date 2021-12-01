<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class ItemApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getItems(array $ids, array $attributes = [])
    {
        $url = 'items/ids?=' . implode(',', $ids) . '&attributes=' . implode(',', $attributes);
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getItem(String $itemId)
    {
        $url = 'items/' . $itemId;
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getSellerItems(Int $user_id, $search_type = null)
    {
        $url = "users/${user_id}/items/search?search_type={$search_type}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getItemShippingOptions(String $itemId)
    {
        $url = "items/${itemId}/shipping_options";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function createItem(array $item)
    {
        $url = 'items';
        $response = $this->post($this->configuration->getAccessToken(), $url, $item);

        $this->createItemDescription($response->id, $item['description']);

        return $response->json();
    }

    public function createItemDescription(String $itemId, array $description)
    {
        $url = "items/${itemId}/description";
        $response = $this->post($this->configuration->getAccessToken(), $url, ['plain_text' => $description]);

        return $response->json();
    }
}

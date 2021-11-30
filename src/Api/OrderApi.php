<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class OrderApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getOrders(string $seller_id = '', string $buyer_id = '')
    {
        $url = "orders/search?seller=${seller_id}&buyer=${buyer_id}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getOrder(string $seller_id = '', string $order_id = '')
    {
        $url = "orders/search?seller=${seller_id}&q=${order_id}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getOrderFeedback(string $order_id)
    {
        $url = "orders/${order_id}/feedback";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getOrderProduct(string $order_id)
    {
        $url = "orders/${order_id}/product";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }
}

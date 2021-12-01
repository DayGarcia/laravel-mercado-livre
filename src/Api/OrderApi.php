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
        !empty($buyer_id) ? $buyer_id = "&buyer={$buyer_id}" : $buyer_id = '';

        $url = "orders/search?seller={$seller_id}{$buyer_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getOrder(string $seller_id = '', string $order_id = '')
    {
        $url = "orders/search?seller=${seller_id}&q=${order_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getOrderFeedback(string $order_id)
    {
        $url = "orders/${order_id}/feedback";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getOrderProduct(string $order_id)
    {
        $url = "orders/${order_id}/product";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getOrderShipments(string $order_id)
    {
        $url = "orders/${order_id}/shipments";
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}

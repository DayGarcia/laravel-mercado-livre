<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class ShipmentApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getShipment(string $shipment_id)
    {
        $url = "shipments/${shipment_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}

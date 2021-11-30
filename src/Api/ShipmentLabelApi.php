<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class ShipmentLabelApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getShipmentLabel(string $shipment_id, string $format = '')
    {
        $format = (!empty($format) && $format == 'pdf') ? 'savePdf=Y' : 'response_type=zpl2';
        $url = "shipment_labels?shipment_ids=${shipment_id}&{$format}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }
}

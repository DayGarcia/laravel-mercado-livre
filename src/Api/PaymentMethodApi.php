<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class PaymentMethodApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getPaymentMethods()
    {
        $url = "sites/" . config('mercadolivre.site_id') . "/payment_methods";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getPaymentMethod(string $payment_method_id)
    {
        $url = "sites/" . config('mercadolivre.site_id') . "/payment_methods/${payment_method_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}

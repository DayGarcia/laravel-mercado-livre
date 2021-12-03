<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class InvoiceApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getInvoices(string $user_id)
    {
        $url = "users/{$user_id}/invoices/orders";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getInvoice(string $user_id, string $invoice_id)
    {
        $url = "users/{$user_id}/invoices/{$invoice_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}

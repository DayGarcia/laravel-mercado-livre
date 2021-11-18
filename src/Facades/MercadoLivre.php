<?php

namespace DayGarcia\LaravelMercadoLivre\Facades;

use \Illuminate\Support\Facades\Facade;

class MercadoLivre extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mercadolivre';
    }
}

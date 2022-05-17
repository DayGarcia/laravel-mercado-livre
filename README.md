# Mercado Livre Laravel

<h4>A package to connect to Mercado Livre API</h4>

## Requirements

PHP 8 and later

## Installation & Usage

### Composer

To install via [composer](http://getcomposer.org/):

```
composer require daygarcia/laravel-mercado-livre
```

## Setup

The `Configuration` constructor takes a single argument: an array containing all configuration needed to connect to Mercado Livre API:

```php
<?php

// Still under development

use Illuminate\Http\Request;

...

$config = new Configuration([
    'code'          => $request['code'],
    'client_id'     => config('mercadolivre.client_id'),
    'secret'        => config('mercadolivre.client_secret'),
    'redirect_uri'  => 'https://localhost.com',
    'type'          => ($request->cookie('refresh_token') !== null && empty($request['code'])) ? 'renew' : 'new',
    'refresh_token' => $request->cookie('refresh_token') ?? null,
]);


```

The access_token returned last for 6 hours.

Getter and setter methods are available for the `Configuration` class. You can directly get and set `code`, `client_id`, `secret`, `redirect_uri`, `type` and `refresh_token`

Alternatively, if you are managing your token by yourself, you dont need request a new token every single API call. You can just pass the token as a value in `Configuration` instance:

```php
<?php

use Illuminate\Http\Request;

...

$config = new Configuration([
    'access_token' => 'APP_USR-fafafafafafa...',
]);


```

## Example

```php
<?php

use DayGarcia\LaravelMercadoLivre\Configuration;

...

public function index(Request $request)
{
    $config = new Configuration([
        'access_token' => $request->cookie('access_token'),
    ]);

    try {
        $meli = new ItemApi($config);
        $items = $meli->getSellerItems($request->cookie('user_id'));
        $response = $meli->getItems($items->results);

        return $this->success($response);
    } catch (Exception $e) {
        return $this->error($e->getMessage(), $e->getCode());
    }
}


```

## Documentation & Important notes

##### The URIs are relative to https://api.mercadolibre.com

##### The Authorization URLs (set the correct country domain): https://auth.mercadolibre.{country_domain}

##### Don’t forget to check out mercado livre developer website [developer site](https://developers.mercadolibre.com/)

## TODO
- [ ] Improve error handling

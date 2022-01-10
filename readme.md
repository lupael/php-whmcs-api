# PHP WHMCS API Client

Simple and PSR7 compatible WHMCS API Client 

## Installation

### Composer

```bash
$ composer require "i4e/php-whmcs-api" "guzzlehttp/guzzle:^7.2" "http-interop/http-factory-guzzle:^1.0"
```

### System Requirements

This package requires:
- **PHP ^7.4 | ^8.0**
- PHP extensions `curl`, `json` and `mbstring` 

## Usage

### Initialize Client 

Basic initialisation of the Client.

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new \i4e\WhmcsApi\Client();
// Auth Credentials with identifier and secret
$client->authenticate('your_identifier', 'your_secret', \i4e\WhmcsApi\Client::AUTH_API_CREDENTIALS);
// Login Credentials with Username and Password (without md5)
$client->authenticate('your_username', 'your_password', \i4e\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);
$client->url('http://<your_whmcs_instance_url>');
```

## Examples

### Get clients

```php
$client->client()->getClients(['search' => 'firstname']);
```

### Get all orders

```php
$client->orders()->getOrders();
```

### Call custom API Route

If your WHMCS instance contains custom API routes, you can also call them without extending the code.

```php
$parameters = ['foo' => 'bar'];
$client->custom()->yourCustomApiName($parameters);
```

## Disclaimer

If you are using this client, please refer to the documentation on the [WHMCS Developer](https://developers.whmcs.com/api/api-index/) page.
The documentation of the API is very incomplete in some places and in some cases questionably documented.


## License

This package is released under the MIT License.

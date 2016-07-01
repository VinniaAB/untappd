# Wrapper for the Untappd API
For more information regarding the api, see https://untappd.com/api/docs

## Dependencies
- php 7.0+
- composer

## Installation
Add a repository to your composer.json like so:
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/VinniaAB/untappd.git"
    }
  ]
}
```

And then require the package with composer:
```shell
composer require vinnia/untappd
```

## Usage
A complete html example is located in `example.php`.

```php
use Vinnia\Untappd\Client;

$client = Client::make('client_id', 'client_secret');

$response = $client->getBreweryInfo($breweryId);

$data = json_decode((string) $response->getBody(), $assoc = true);
var_dump($data);
```

## Testing
Copy `env.sample.php` into `env.php` and enter your web service key and a valid tracking number. Then run the tests:
```shell
vendor/bin/codecept run
```

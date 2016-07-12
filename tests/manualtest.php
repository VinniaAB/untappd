<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 09/07/16
 * Time: 07:50
 */

require __DIR__."/../vendor/autoload.php";

$env = require __DIR__."/../env.php";
//var_dump($env);
//$untappdClient = \Vinnia\Untappd\Client::make($env['client_id'], $env['client_secret']);
$untappdClient = new \Vinnia\Untappd\Client(new \GuzzleHttp\Client(), $env['client_id'], $env['client_secret'], $env['access_token']);
//$response = $untappdClient->searchBrewery('Carnegiebryggeriet');
//$response = $untappdClient->getBreweryInfo(82706);
$response = $untappdClient->getBreweryBeers(82706);
//$response = $untappdClient->getBeers('Nya_Carnegiebryggeriet');
//var_dump(json_decode((string) $response->getBody(), true));


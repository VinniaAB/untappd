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
$untappdClient = \Vinnia\Untappd\Client::make($env['client_id'], $env['client_secret']);
//$response = $untappdClient->searchBrewery('Carnegiebryggeriet');
$response = $untappdClient->getBreweryInfo(82706);
var_dump(json_decode((string) $response->getBody(), true));

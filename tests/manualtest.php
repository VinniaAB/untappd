<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 09/07/16
 * Time: 07:50
 */
namespace Vinnia\Untappd;

require __DIR__."/../vendor/autoload.php";


$env = require __DIR__."/../env.php";
//var_dump($env);
//$untappdClient = \Vinnia\Untappd\Client::make($env['client_id'], $env['client_secret']);
//$untappdClient = new \Vinnia\Untappd\Client(new \GuzzleHttp\Client(), $env['client_id'], $env['client_secret'], $env['access_token']);
//$response = $untappdClient->searchBrewery('Carnegiebryggeriet');
//$response = $untappdClient->getBreweryInfo(82706);

//$response = $untappdClient->getBeers('Nya_Carnegiebryggeriet');
//var_dump(json_decode((string) $response->getBody(), true));

//$response2 = $untappdClient->getBreweryBeers(82706);
/*foreach ($response2 as $res) {
    var_dump(json_decode((string) $res->getBody(), true));
}*/

$utfbClient = UtfbClient::make($env['utfb_login'], $env['utfb_auth_token']);
//$utfbResponse = $utfbClient->getMenus(1961);
//$utfbResponse = $utfbClient->getSections(3159);
$utfbResponse = $utfbClient->getItems(9584);
var_dump(json_decode((string) $utfbResponse->getBody(), true));

//menu id 3159
//section id 9584
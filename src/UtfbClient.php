<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 08/08/16
 * Time: 13:38
 */

namespace Vinnia\Untappd;

use \GuzzleHttp\ClientInterface as GuzzleClientInterface;

class UtfbClient
{
    const API_URL = "https://business.untappd.com/api/v1";
    protected $apiKey;

    private $authToken;
    private $login;
    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * UtfbClient constructor.
     */
    public function __construct(GuzzleClientInterface $client, $login, $authToken)
    {
        $this->authToken = $authToken;
        $this->login = $login;
        $this->client = $client;

        $this->apiKey = $this->createApiKey();
    }

    public static function make($login, $authToken)
    {
        $guzzle = new \GuzzleHttp\Client();
        return new self($guzzle, $login, $authToken);

    }

    public static function createAuthToken($login, $password)
    {
        $guzzle = new \GuzzleHttp\Client();
        return $guzzle->request('POST', self::API_URL . '', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'query' => [
                'email' => $login,
                'password' => $password
            ]
        ]);
    }

    public function getLocations()
    {
        $options = $this->addCommonHeaders();
        return $this->client->request('GET', self::API_URL."/locations", $options);
    }

    public function getMenus($locationId)
    {
        $options = $this->addCommonHeaders();
        return $this->client->request('GET', self::API_URL."/locations/$locationId/menus", $options);
    }

    public function getSections($menuId)
    {
        $options = $this->addCommonHeaders();
        return $this->client->request('GET', self::API_URL."/menus/$menuId/sections", $options);
    }

    public function getItems($sectionId)
    {
        $options = $this->addCommonHeaders();
        return $this->client->request('GET', self::API_URL."/sections/$sectionId/items", $options);
    }

    private function createApiKey()
    {
        return base64_encode($this->login . ":" . $this->authToken);
    }

    private function addCommonHeaders()
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '. $this->apiKey
            ]
        ];
    }
}
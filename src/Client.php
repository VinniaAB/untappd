<?php
/**
 * Created by PhpStorm.
 * User: Joakim
 * Date: 2016-07-01
 * Time: 16:45
 */

namespace Vinnia\Untappd;

use \GuzzleHttp\ClientInterface as GuzzleClientInterface;

class Client
{
    const API_URL = 'https://api.untappd.com/v4';
    const CONTENT_TYPE_JSON = 'application/json; charset=utf-8';

    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * Client constructor.
     * @param GuzzleClientInterface $client
     * @param $clientId
     * @param $clientSecret
     * @param $accessToken
     */
    function __construct(GuzzleClientInterface $client, $clientId, $clientSecret, $accessToken = '')
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->accessToken = $accessToken;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return Client
     */
    public static function make($clientId, $clientSecret)
    {
        $guzzle = new \GuzzleHttp\Client();
        return new self($guzzle, $clientId, $clientSecret);
    }

    /**
     * @param int $breweryId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBreweryInfo(int $breweryId)
    {
        $options = $this->getStandardHeaders();
        return $this->client->request('GET', self::API_URL . '/brewery/info/' . (string)$breweryId, $options);
    }

    public function getBeers($username = '')
    {
        $options = $this->getStandardHeaders();
        return $this->client->request('GET', self::API_URL.'/user/beers/'. (string)$username, $options);
    }

    /**
     * @param string $searchString
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchBrewery(string $searchString)
    {
        $options = array_merge_recursive([
            'query' => [
                'q' => $searchString
            ]
        ], $this->getStandardHeaders());

        return $this->client->request('GET', self::API_URL.'/search/brewery', $options);
    }

    private function getStandardHeaders()
    {
        if (! empty($this->accessToken)) {
            return [
                'headers' => [
                    'Accept' => self::CONTENT_TYPE_JSON
                ],
                'query' => [
                    'access_token' => $this->accessToken,
                ]
            ];
        }


        return [
            'headers' => [
                'Accept' => self::CONTENT_TYPE_JSON
            ],
            'query' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ]
        ];
    }

}

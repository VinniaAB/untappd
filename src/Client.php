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
    function __construct(GuzzleClientInterface $client, $clientId, $clientSecret, $accessToken = null)
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
        return $this->client->request('GET', self::API_URL.'/brewery/info/'.(string) $breweryId, [
            'headers' => [
                'Accept' => self::CONTENT_TYPE_JSON
            ],
            'query' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]
        ]);
    }

}

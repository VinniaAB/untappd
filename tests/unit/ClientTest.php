<?php
/**
 * Created by PhpStorm.
 * User: Joakim
 * Date: 2016-07-01
 * Time: 17:33
 */

namespace Vinnia\Untappd\Tests;


use Vinnia\Untappd\Client;

class ClientTest extends AbstractTest
{

    /**
     * @var Client
     */
    public $client;

    /**
     * @var string[]
     */
    public $env;

    public function setUp()
    {
        parent::setUp();

        $this->env = require __DIR__ . '/../../env.php';
        $this->client = Client::make($this->env['cliend_id'], $this->env['client_secret']);
    }

    public function testGetBreweryInfo()
    {
        $breweryId = 10;
        $res = $this->client->getBreweryInfo($breweryId);
        $data = json_decode((string) $res->getBody(), true);

        codecept_debug($data);

        $this->assertEquals($breweryId, $data['brewery']['brewery_id']);
    }

}

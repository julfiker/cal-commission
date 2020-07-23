<?php

namespace Julfiker\Managers;

use GuzzleHttp\Client;
use Julfiker\Configs\Config;
use Julfiker\Contracts\ApiManagerInterface;

/**
 * Class ApiManager design to integrate any other party api
 *
 * @package Julfiker\Managers
 */
class ApiManager implements ApiManagerInterface
{
    /** @var Client  */
    private $client;

    /**
     * BinManager constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @inheritDoc
     */
    public function getBinResult(int $bin) : \stdClass
    {

        $result = $this->client->request('GET',Config::BIN_API.'/'.$bin);
        if (!$result->getBody())
            throw new \Exception('Bin api response error.');

        return json_decode($result->getBody());
    }

    /**
     * @inheritDoc
     */
    public function getExchangeRate() : \stdClass
    {
        $response = $this->client->request('get',Config::EXCHANGE_RATE_API);
        return json_decode($response->getBody())->rates;
    }
}
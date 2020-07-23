<?php


namespace Tests;
use GuzzleHttp\Client;
use Julfiker\Managers\ApiManager;
use PHPUnit\Framework\TestCase;


class ApiManagerTest extends TestCase
{
    private $apiManager;

    public function testBinApi() {
        $apiManager = new ApiManager(new Client());
        $result = $apiManager->getBinResult('45717360');
        $this->assertEquals($result->country->alpha2, 'DK');
    }

    public function testExchangeRateApi() {
        $apiManager = new ApiManager(new Client());
        $result = (array)$apiManager->getExchangeRate();
        $this->assertArrayHasKey('USD',$result);
    }


}
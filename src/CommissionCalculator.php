<?php

namespace Julfiker;

use GuzzleHttp\Client;

/**
 * A commission calculator class
 *
 * Class CommissionCalculator
 * @package Julfiker
 */
class CommissionCalculator
{
    /**
     * @var data
     */
    private $data;

    /** @var Client  */
    protected $client;

    /**
     * @var Bin api url
     */
    protected $binApi;

    /**
     * @var exchange rate api url
     */
    protected $exchangeRateApi;

    /**
     * CommissionCalculator constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get bin result through api
     *
     * @return stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getBinResult() : \stdClass
    {
       if (!$this->data->bin)
           throw new \Exception('Bin not found.');

       $result = $this->client->request('GET',$this->binApi.'/'.$this->data->bin);
       if (!$result->getBody())
           throw new \Exception('Bin api response error.');

       return json_decode($result->getBody());
    }

    /**
     * Get exchange rate
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getExchangeRate() : \stdClass
    {
        $response = $this->client->request('get', $this->exchangeRateApi);
        return json_decode($response->getBody())->rates;
    }

    /**
     * Get amount
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getAmount() : float
    {
        $rate = $this->getExchangeRate();
        if (!isset($rate->{$this->data->currency}) || $this->data->currency == 'EUR')
            return $this->data->amount;

        return $this->data->amount / $rate->{$this->data->currency};
    }

    /**
     * @param $value
     * @param int $places
     * @return float
     */
    private function roundUp($value, $places=0) : float
    {
        if ($places < 0) { $places = 0; }
        $mult = pow(10, $places);
        return ceil($value * $mult) / $mult;
    }


    /**
     * @return mixed
     */
    public function getData() : \stdClass
    {
        return $this->data;
    }

    /**
     * set input data
     *
     * @param string $data
     * @return CommissionCalculator
     * @throws \Exception
     */
    public function setData(string  $data) : CommissionCalculator
    {
        $this->data = json_decode($data);
        if (!is_object($this->data))
            throw new \Exception('Invalid row data in input txt');

        return $this;
    }

    /**
     * @param mixed $binApi
     * @return CommissionCalculator
     */
    public function setBinApi(string  $binApi) : CommissionCalculator
    {
        $this->binApi = $binApi;
        return $this;
    }

    /**
     * @param mixed $exchangeRateApi
     * @return CommissionCalculator
     */
    public function setExchangeRateApi($exchangeRateApi) : CommissionCalculator
    {
        $this->exchangeRateApi = $exchangeRateApi;
        return $this;
    }

    /**
     * Calculating commission
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculate() : float {
       $binResult = $this->getBinResult();
       $country = $binResult->country->alpha2;
       $amount = $this->getAmount();
       return
           $this->roundUp(
               $amount * (CountryEnum::isEu($country) ? 0.01 : 0.02),
               2
               );
    }
}    
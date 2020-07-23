<?php


namespace Julfiker\Managers;

/**
 * Class ExchangeRateManager
 * @package Julfiker\Managers
 */
class ExchangeRateManager
{

    /** @var ApiManager */
    private $apiManager;

    /**
     * @return mixed|\stdClass
     * @throws \Exception
     */
    private function getExchangeRateThroughApi() :\stdClass
    {
        if ($api = $this->getApiManager()) {
            return $api->getExchangeRate();
        }

        throw new \Exception('Something went wrong, might be ApiManager not injected.');
    }

    /**
     * @return mixed|\stdClass
     * @throws \Exception
     */
    public function getExchangeRates() {
        return $this->getExchangeRateThroughApi();
    }

    /**
     * @return ApiManager
     */
    public function getApiManager(): ApiManager
    {
        return $this->apiManager;
    }

    /**
     * @param ApiManager $apiManager
     * @return ExchangeRateManager
     */
    public function setApiManager(ApiManager $apiManager): ExchangeRateManager
    {
        $this->apiManager = $apiManager;
        return $this;
    }
}
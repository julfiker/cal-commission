<?php

namespace Julfiker\Managers;

/**
 * Class BinManager
 * @package Julfiker\Managers
 */
class BinManager
{
    /** @var ApiManager */
    private $apiManager;

    /**
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getBinRecordThroughApi(int $bin): \stdClass
    {
        if ($api = $this->apiManager) {
            return $api->getBinResult($bin);
        }

        throw new \Exception('Something went wrong, might be ApiManager not injected.');
    }

    /**
     * @param $bin
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBinRecords(int $bin) {
        return $this->getBinRecordThroughApi($bin);
    }

    /**
     * @param ApiManager $apiManager
     * @return BinManager
     */
    public function setApiManager(ApiManager $apiManager): BinManager
    {
        $this->apiManager = $apiManager;
        return $this;
    }
}
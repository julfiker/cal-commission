<?php

namespace Julfiker\Contracts;

/**
 * Interface ApiManagerInterface
 * @package Julfiker\Contracts
 */
interface ApiManagerInterface
{

    /**
     * Get Bin result through api call
     *
     * @param int $bin
     * @return mixed
     */
    public function getBinResult(int $bin);

    /**
     * Current exchange rate through api call
     *
     * @return mixed
     */
    public function getExchangeRate();
}
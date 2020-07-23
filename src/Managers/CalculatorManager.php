<?php

namespace Julfiker\Managers;

use Julfiker\Configs\Config;
use Julfiker\Entities\Transaction;

/**
 * Class CalculatorManager
 *
 * @package Julfiker\Managers
 */
class CalculatorManager
{
    /** @var BinManager */
    private $binManager;

    /** @var ExchangeRateManager */
    private $exchangeRateManager;

    /** @var Transaction */
    private $transaction;

    /**
     * CalculatorManager constructor
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * GET transaction amount with adjust exchange rate
     *
     * @return float
     * @throws \Exception
     */
    private function getAmount(): float
    {
        //var_dump($this->getTransaction()); die();
        $rate = $this->getExchangeRateManager()->getExchangeRates();
        //var_dump($rate->{$this->getTransaction()->getCurrency()}); die();
        if (!isset($rate->{$this->getTransaction()->getCurrency()}) || $this->getTransaction()->getCurrency() == 'EUR')
            return $this->getTransaction()->getAmount();

        return $this->getTransaction()->getAmount() / $rate->{$this->getTransaction()->getCurrency()};
    }

    /**
     * @return bool
     * @param string $country
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function isEu(string  $country): bool
    {
        //print_r(Config::EU); die();
        return  in_array($country, Config::EU);
    }

    /**
     * @return Transaction
     * @throws \Exception
     */
    public function getTransaction(): Transaction
    {
        if ($this->transaction)
            return $this->transaction;

        throw new \Exception('No transaction found.');
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculate()
    {
        $binResult = $this->getBinManager()->getBinRecords($this->getTransaction()->getBin());
        $country = $binResult->country->alpha2;
        $amount = $this->getAmount();
        return
            $this->roundUp(
                $amount * ($this->isEu($country) ? Config::EU_RATE :Config::NON_EU_RATE),
                Config::ROUND_DECIMAL_DIGIT
            );
    }

    /**
     * @return BinManager
     */
    public function getBinManager(): BinManager
    {
        return $this->binManager;
    }

    /**
     * @param BinManager $binManager
     * @return CalculatorManager
     */
    public function setBinManager(BinManager $binManager): CalculatorManager
    {
        $this->binManager = $binManager;
        return $this;
    }

    /**
     * @return ExchangeRateManager
     */
    public function getExchangeRateManager(): ExchangeRateManager
    {
        return $this->exchangeRateManager;
    }

    /**
     * @param ExchangeRateManager $exchangeRateManager
     * @return CalculatorManager
     */
    public function setExchangeRateManager(ExchangeRateManager $exchangeRateManager): CalculatorManager
    {
        $this->exchangeRateManager = $exchangeRateManager;
        return $this;
    }
}
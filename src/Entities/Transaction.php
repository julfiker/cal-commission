<?php


namespace Julfiker\Entities;

/**
 * Class Transaction
 *
 * @package Julfiker\Entities
 */
class Transaction
{
    /** @var integer */
    private $bin;

    /** @var float */
    private $amount;

    /** @var string */
    private $currency;

    /**
     * Transaction constructor.
     *
     * @param int $bin
     * @param float $amount
     * @param string $currency
     */
    public function __construct(int $bin, float $amount, string $currency)
    {
        $this->bin = $bin;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getBin(): int
    {
        return $this->bin;
    }

    /**
     * @param int $bin
     * @return Transaction
     */
    public function setBin(int $bin): Transaction
    {
        $this->bin = $bin;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Transaction
     */
    public function setAmount(float $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Transaction
     */
    public function setCurrency(string $currency): Transaction
    {
        $this->currency = $currency;
        return $this;
    }
}
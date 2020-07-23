<?php


namespace Julfiker;

use GuzzleHttp\Client;
use Julfiker\Entities\Transaction;
use Julfiker\Managers\ApiManager;
use Julfiker\Managers\BinManager;
use Julfiker\Managers\CalculatorManager;
use Julfiker\Managers\ExchangeRateManager;

/**
 * A singleton class for application bootstrap
 *
 * Class Application
 * @package Julfiker
 */
class Application
{

    /** @var Application|null  */
    private static $instance = null;

    private $binManager;
    private $exchangeRateManager;

    private function __construct(BinManager $binManager, ExchangeRateManager $exchangeRateManager)
    {
        $this->binManager = $binManager;
        $this->exchangeRateManager = $exchangeRateManager;
    }

    /**
     * @return Application
     */
    public static function getInstance() : Application
    {
        if (self::$instance == null) {
            $client = new Client();
            $apiManager = new ApiManager($client);
            $binManager = new BinManager();
            $binManager->setApiManager($apiManager);
            $exchangeRateManager = new ExchangeRateManager();
            $exchangeRateManager->setApiManager($apiManager);
            self::$instance = new Application($binManager, $exchangeRateManager);
        }

        return self::$instance;
    }

    public function run()
    {
        //Todo: other application bootstrap staff
        return self::$instance;
    }

    /**
     * @param  $file
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handleInput($file) {
        $i=0;
        while(!feof($file)) {
            $i++;
            try {
                $data = json_decode(fgets($file), true);
                echo $this->calculateAmount($data);
            }
            catch (Exception $e) {
                echo $e->getMessage() . ' at line '.$i;
            }
            echo "\n";
        }
        fclose($file);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function calculateAmount (array $data) {
        $transaction =new Transaction($data['bin'], $data['amount'], $data['currency']);

        //can be used in setter based mapped, useful for kind of validation in setter method
        //$transaction = $this->mappedTransaction($data);

        $calculator = new CalculatorManager($transaction);
        return $calculator->setBinManager($this->binManager)
                   ->setExchangeRateManager($this->exchangeRateManager)
                   ->calculate();

    }

    /**
     * Get Transaction with mapped data
     *
     * @param array $data
     * @return Transaction
     */
    public function mappedTransaction(array $data) : Transaction {
        $transaction = new Transaction();
        return $transaction->setBin($data['bin'])
                     ->setAmount($data['amount'])
                     ->setCurrency('currency');
    }
}
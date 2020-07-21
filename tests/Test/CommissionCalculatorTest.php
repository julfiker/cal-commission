<?php
namespace Tests;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Julfiker\CommissionCalculator;


/**
 * Some test cases example here.. we can add here as we need
 *
 * Class CommissionCalculatorTest
 * @package Tests
 */
class CommissionCalculatorTest extends TestCase
{
    /**
     * EUR calculation
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testEUCalculation() {
        $client = new Client();
        $calculator = new CommissionCalculator($client);
        $calculator->setBinApi('https://lookup.binlist.net')
            ->setExchangeRateApi('https://api.exchangeratesapi.io/latest');

        $data = '{"bin":"45717360","amount":"100.00","currency":"EUR"}';
        $amount = $calculator->setData($data)
            ->calculate();

        $this->assertEquals(
           1,
           $amount
        );
    }

    /**
     * Other currency like USD rather EUR
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testNonEUCalculation() {
        $client = new Client();
        $calculator = new CommissionCalculator($client);
        $calculator->setBinApi('https://lookup.binlist.net')
            ->setExchangeRateApi('https://api.exchangeratesapi.io/latest');

        $data = '{"bin":"41417360","amount":"130.00","currency":"USD"}';
        $amount = $calculator->setData($data)
            ->calculate();

        $this->assertEquals(
            2.28,
            $amount
        );
    }

    /**
     * @throws \Exception
     */
    public function testSetDataProperly() {
        $data = '{"bin":"41417360","amount":"130.00","currency":"USD"}';

        $client = new Client();
        $calculator = new CommissionCalculator($client);
        $calculator->setData($data);
        $this->assertEquals(json_decode($data), $calculator->getData());
    }
}
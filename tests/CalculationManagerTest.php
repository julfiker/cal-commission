<?php


namespace Tests;
use Julfiker\Entities\Transaction;
use Julfiker\Managers\CalculatorManager;
use PHPUnit\Framework\TestCase;

class CalculationManagerTest extends TestCase
{
    private $calculatorManager;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $data = json_decode('{"bin":"45717360","amount":"100.00","currency":"EUR"}', true);
        $t = new Transaction($data['bin'],$data['amount'], $data['currency']);
        $this->calculatorManager = new CalculatorManager($t);
    }

    public function testTransactionInject() {
        $data = json_decode('{"bin":"45717360","amount":"100.00","currency":"EUR"}', true);
        $t = new Transaction($data['bin'],$data['amount'], $data['currency']);
        $this->assertEquals($t,$this->calculatorManager->getTransaction());
    }

    public function testIsEu() {
        $this->assertTrue($this->callMethod($this->calculatorManager, 'isEu', ['DK']));
    }

    public function testRoundUp() {
        $this->assertEquals($this->callMethod($this->calculatorManager, 'roundUp', [0.232,2]), 0.24);
    }

    private function callMethod($object, string $method , array $parameters = [])
    {
        try {
            $className = get_class($object);
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            throw new \Exception($e->getMessage());
        }

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
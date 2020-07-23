<?php


namespace Tests;
use Julfiker\Entities\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionEntityTest extends TestCase
{
    public function testTransactionEntityCreateObject() {
        $t = new Transaction(45717360,100.00, 'EUR');
        $this->assertTrue($t->getBin() == 45717360 && $t->getCurrency()=='EUR' && $t->getAmount() == 100.00, 'Checking Transaction entity mapped all properties');
    }
}
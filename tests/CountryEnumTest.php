<?php

namespace Tests;
use Julfiker\CountryEnum;
use PHPUnit\Framework\TestCase;

class CountryEnumTest extends TestCase
{
    public function testEuConst() {
        $eu = [
            'AT',
            'BE',
            'BG',
            'CY',
            'CZ',
            'DE',
            'DK',
            'EE',
            'ES',
            'FI',
            'FR',
            'GR',
            'HR',
            'HU',
            'IE',
            'IT',
            'LT',
            'LU',
            'LV',
            'MT',
            'NL',
            'PO',
            'PT',
            'RO',
            'SE',
            'SI',
            'SK',
        ];

        $this->assertEquals($eu, CountryEnum::EU);
    }

    public function testIsEU() {
        $this->assertTrue(CountryEnum::isEu('DK')===true,'Checking country is in EU');;
    }

}
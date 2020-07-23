<?php
namespace Julfiker\Configs;

/**
 * Class Config
 * @package Julfiker\Configs
 */
abstract class Config
{
    /**
     * Constant for Eu countries
     */
    const EU = [
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

    const BIN_API = 'https://lookup.binlist.net';

    const EXCHANGE_RATE_API = 'https://api.exchangeratesapi.io/latest';

    const EU_RATE = 0.01;

    const NON_EU_RATE = 0.02;

    const ROUND_DECIMAL_DIGIT = 2;
}
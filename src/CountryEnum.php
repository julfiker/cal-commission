<?php


namespace Julfiker;

/**
 * Class CountryEnum
 *
 * @package Julfiker
 */
abstract class CountryEnum
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

    /**
     * Check country is EU or bot
     *
     * @param $country
     * @return bool
     */
    public static function isEu($country) : bool {
        return in_array($country,self::EU);
    }

}

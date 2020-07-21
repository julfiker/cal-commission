<?php
require_once __DIR__."/vendor/autoload.php";
$client = new \GuzzleHttp\Client();

$calculator = new \Julfiker\CommissionCalculator($client);
$calculator->setBinApi('https://lookup.binlist.net')
           ->setExchangeRateApi('https://api.exchangeratesapi.io/latest');

$file = fopen($argv[1], 'r');

$i=0;
while(!feof($file)) {
    $i++;
    try {
        echo $calculator->setData(fgets($file))
            ->calculate();
    }
    catch (Exception $e) {
        echo $e->getMessage() . ' at line '.$i;
    }
    echo "\n";
}

fclose($file);


<?php

require __DIR__ . '/vendor/autoload.php';

use Mkhvsl\MvCommissionsApp\CommissionCalculator;
use Mkhvsl\MvCommissionsApp\BinListProvider;
use Mkhvsl\MvCommissionsApp\ExchangeRatesApiProvider;

$inputFile = $argv[1] ?? null;
if (!$inputFile || !file_exists($inputFile)) {
    die("Missing or invalid input file\n");
}

$calculator = new CommissionCalculator(
    new BinListProvider(),
    new ExchangeRatesApiProvider()
);

foreach (file($inputFile) as $line) {
    if (empty(trim($line))) continue;

    $data = json_decode($line, true);

    try {
        $commission = $calculator->calculate($data['bin'], (float) $data['amount'], $data['currency']);

        echo $commission . "\n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
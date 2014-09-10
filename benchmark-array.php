<?php

$time = microtime(true);

include 'CurrencyArray.php';

// Get 158 currency codes & their names.
$names = CurrencyService::getNames();

// Get the symbol and fraction digits for a few currencies. This data is usually
// used when formatting amounts, and prices in the system usually have only
// a few currencies.
$currencyData = array();
foreach (array('USD', 'EUR', 'GBP') as $currencyCode) {
  $currencyData[$currencyCode]['symbol'] = CurrencyService::getSymbol($currencyCode);
  $currencyData[$currencyCode]['fraction_digits'] = CurrencyService::getFractionDigits($currencyCode);
}

echo 'Nb of Currencies: '.count($names)."\n";
echo 'Time: '.((microtime(true) - $time)*1000)."ms\n";
echo 'Memory: '.(memory_get_usage(true)/1024)."kB\n";
echo 'Peak Memory: '.(memory_get_peak_usage(true)/1024)."kB\n";

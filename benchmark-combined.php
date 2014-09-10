<?php

$time = microtime(true);

include 'CurrencyCombined.php';

// Get 158 currency codes & their names.
$names = CurrencyService::getNames();

// Get the full data for a few currencies. This data is usually
// used when formatting amounts, and prices in the system usually have only
// a few currencies.
$currencyData = array();
foreach (array('USD', 'EUR', 'GBP') as $currencyCode) {
  $currencyData[$currencyCode] = CurrencyService::getCurrency($currencyCode);
}

echo 'Nb of Currencies: '.count($names)."\n";
echo 'Time: '.((microtime(true) - $time)*1000)."ms\n";
echo 'Memory: '.(memory_get_usage(true)/1024)."kB\n";
echo 'Peak Memory: '.(memory_get_peak_usage(true)/1024)."kB\n";

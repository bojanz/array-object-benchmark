<?php

include 'Currency.php';

$time = microtime(true);

// Get all 158 currency names.
$manager = new CurrencyManager();
$names = $manager->getNames();

echo 'Nb of Currencies: '.count($names)."\n";
echo 'Time: '.((microtime(true) - $time)*1000)."ms\n";
echo 'Memory: '.(memory_get_usage(true)/1024)."kB\n";
echo 'Peak Memory: '.(memory_get_peak_usage(true)/1024)."kB\n";

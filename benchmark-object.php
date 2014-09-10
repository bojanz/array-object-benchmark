<?php

$time = microtime(true);

include 'CurrencyObject.php';

// Get all 158 currency objects.
$manager = new CurrencyManager();
$currencies = $manager->getAll();

echo 'Nb of Currencies: '.count($currencies)."\n";
echo 'Time: '.((microtime(true) - $time)*1000)."ms\n";
echo 'Memory: '.(memory_get_usage(true)/1024)."kB\n";
echo 'Peak Memory: '.(memory_get_peak_usage(true)/1024)."kB\n";
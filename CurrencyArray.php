<?php

class CurrencyService
{
    private static $data;

    public static function getData()
    {
        if (!isset(self::$data)) {
            self::$data = json_decode(file_get_contents(__DIR__.'/en.json'));
        }

        return self::$data;
    }

    public static function getNames()
    {
        $data = self::getData();
        $names = array();
        foreach ($data as $currencyCode => $currencyDefinition) {
            $names[$currencyCode] = $currencyDefinition->name;
        }

        return $names;
    }

    public static function getSymbol($currencyCode)
    {
        $data = self::getData();
        return $data->{$currencyCode}->symbol;
    }

    public static function getNumericCode($currencyCode)
    {
        $data = self::getData();
        return $data->{$currencyCode}->numeric_code;
    }

    public static function getFractionDigits($currencyCode)
    {
        $data = self::getData();
        return isset($data->{$currencyCode}->fraction_digits) ?: 2;
    }
}

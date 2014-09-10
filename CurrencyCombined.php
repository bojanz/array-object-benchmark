<?php

interface CurrencyInterface
{
    public function getCurrencyCode();
    public function setCurrencyCode($currencyCode);

    public function getName();
    public function setName($name);

    public function getNumericCode();
    public function setNumericCode($numericCode);

    public function getSymbol();
    public function setSymbol($symbol);

    public function getFractionDigits();
    public function setFractionDigits($fractionDigits);
}

class Currency implements CurrencyInterface
{
    protected $currencyCode;
    protected $name;
    protected $numericCode;
    protected $symbol;
    protected $fractionDigits;

    public function __toString()
    {
        return $this->getCurrencyCode();
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getNumericCode()
    {
        return $this->numericCode;
    }

    public function setNumericCode($numericCode)
    {
        $this->numericCode = $numericCode;

        return $this;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getFractionDigits()
    {
        return $this->fractionDigits;
    }

    public function setFractionDigits($fractionDigits)
    {
        $this->fractionDigits = $fractionDigits;

        return $this;
    }
}

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

    public function getCurrency($currencyCode)
    {
        $data = self::getData();
        $currencyDefinition = $data->{$currencyCode};

        $fractionDigits = isset($currencyDefinition->fraction_digits) ?: 2;
        $currency = new Currency;
        $currency->setCurrencyCode($currencyDefinition->code);
        $currency->setName($currencyDefinition->name);
        $currency->setSymbol($currencyDefinition->symbol);
        $currency->setNumericCode($currencyDefinition->numeric_code);
        $currency->setFractionDigits($fractionDigits);

        return $currency;
    }
}

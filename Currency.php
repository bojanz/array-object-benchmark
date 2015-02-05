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

    public function __construct($currencyCode = null, $name = null, $symbol = null, $numericCode = null, $fractionDigits = null)
    {
        $this->currencyCode = $currencyCode;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->fractionDigits = $fractionDigits;
    }

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

class CurrencyManager
{
    private $data;

    public function __construct()
    {
        $this->data = json_decode(file_get_contents(__DIR__.'/en.json'), true);
    }

    public function getNames()
    {
        $names = array();
        foreach ($this->data as $currencyCode => $definition) {
            $names[$currencyCode] = $definition['name'];
        }
    }

    public function getAll()
    {
        $currencies = array();
        foreach ($this->data as $currencyCode => $definition) {
            $fractionDigits = isset($definition['fraction_digits']) ?: 2;

            $currency = new Currency($definition['code'], $definition['name'], $definition['symbol'], $definition['numeric_code'], $fractionDigits);
            $currencies[$currencyCode] = $currency;
        }

        return $currencies;
    }

    public function getAll2()
    {
        $currencies = array();
        foreach ($this->data as $currencyCode => $definition) {
            $fractionDigits = isset($definition['fraction_digits']) ?: 2;

            $currency = new Currency();
            $currency->setCurrencyCode($definition['code']);
            $currency->setName($definition['name']);
            $currency->setSymbol($definition['symbol']);
            $currency->setNumericCode($definition['numeric_code']);
            $currency->setFractionDigits($fractionDigits);
            $currencies[$currencyCode] = $currency;
        }

        return $currencies;
    }

    public function getAll3()
    {
        $currencies = array();
        foreach ($this->data as $currencyCode => $definition) {
            $currency = new Currency();
            $setValues = Closure::bind(function ($definition) {
                $this->currencyCode = $definition['code'];
                $this->name = $definition['name'];
                $this->symbol = $definition['symbol'];
                $this->numericCode = $definition['numeric_code'];
                $this->fractionDigits = isset($definition['fraction_digits']) ?: 2;
            }, $currency, 'Currency');
            $setValues($definition);

            $currencies[$currencyCode] = $currency;
        }

        return $currencies;
    }
}

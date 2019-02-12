<?php

namespace App;

class Ad
{

    private $id;
    private $name;
    private $text;
    private $dollarPrice;

    public function __construct(int $id, string $name, string $text, float $dollarPrice)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->text        = $text;
        $this->dollarPrice = $dollarPrice;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $currency
     *
     * @return float
     * @throws \Exception
     */
    public function getPrice($currency = CurrencyConverter::USD): float
    {
        $price = $this->dollarPrice;

        if ($currency !== CurrencyConverter::USD) {
            static $converter = null;
            if ($converter === null) {
                $converter = new CurrencyConverter();
            }
            $price = $converter->convert($price, CurrencyConverter::USD, $currency);
        }

        return $price;
    }

    // TODO: setters
}
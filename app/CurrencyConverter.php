<?php

namespace App;

class CurrencyConverter
{
    // эх, тут бы "mad-web/laravel-enum", но лень
    const USD = 'USD';
    const RUB = 'RUB';
    const EUR = 'EUR';

    const CURRENCIES_ENUM = [
        self::USD => 1,
        self::RUB => 67,
        self::EUR => 0.5,
    ];

    /**
     * @param float $price
     * @param string $from
     * @param string $to
     *
     * @return float
     * @throws \Exception
     */
    public function convert(float $price, string $from, string $to): float
    {
        if ($price === 0 || $from == $to) {
            return $price;
        }

        if (!isset(self::CURRENCIES_ENUM[$from])) {
            throw new \Exception('From currency unsupported');
        }

        if (!isset(self::CURRENCIES_ENUM[$to])) {
            throw new \Exception('To currency unsupported');
        }

        $price = $price / self::CURRENCIES_ENUM[$from] * self::CURRENCIES_ENUM[$to];

        return $price;
    }
}
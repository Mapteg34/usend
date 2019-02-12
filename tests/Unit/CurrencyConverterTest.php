<?php

namespace Tests\Unit;

use App\CurrencyConverter;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    /**
     * @var CurrencyConverter
     */
    private $converter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new CurrencyConverter();
    }

    /**
     * @param $price
     * @param $from
     * @param $to
     * @param $result
     *
     * @dataProvider providerMain
     *
     * @throws \Exception
     */
    public function testMain($price, $from, $to, $result)
    {
        $this->assertEquals($this->converter->convert($price, $from, $to), $result);
    }

    public function providerMain()
    {
        $data = [];
        foreach (CurrencyConverter::CURRENCIES_ENUM as $from => $fromCourse) {
            foreach (CurrencyConverter::CURRENCIES_ENUM as $to => $toCourse) {
                $base   = rand(10, 100);
                $data[] = [$base, $from, $to, $base / $fromCourse * $toCourse];
            }
        }

        return $data;
    }

    /**
     * @throws \Exception
     */
    public function testExceptionFrom()
    {
        $this->expectException('Exception');
        $this->converter->convert(rand(10, 100), rand(1, 10), CurrencyConverter::USD);
    }

    /**
     * @throws \Exception
     */
    public function testExceptionTo()
    {
        $this->expectException('Exception');
        $converter = new CurrencyConverter();
        $converter->convert(rand(10, 100), CurrencyConverter::USD, rand(1, 10));
    }

    /**
     * @throws \Exception
     */
    public function testNoConvert()
    {
        $price = rand(10, 100);
        $this->assertEquals(
            $this->converter->convert($price, CurrencyConverter::USD, CurrencyConverter::USD),
            $price
        );
        $this->assertEquals(
            $this->converter->convert(0, CurrencyConverter::USD, CurrencyConverter::USD),
            0
        );
    }
}

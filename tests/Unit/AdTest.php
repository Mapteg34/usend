<?php

namespace Tests\Unit;

use App\Ad;
use PHPUnit\Framework\TestCase;

class AdTest extends TestCase
{
    /**
     * @param $id
     * @param $name
     * @param $text
     * @param $price
     *
     * @dataProvider providerMain
     *
     * @throws \Exception
     */
    public function testMain($id, $name, $text, $price)
    {
        $ad = new Ad($id, $name, $text, $price);
        $this->assertEquals($ad->getId(), $id);
        $this->assertEquals($ad->getName(), $name);
        $this->assertEquals($ad->getText(), $text);
        $this->assertEquals($ad->getPrice(), $price);
    }

    public function providerMain()
    {
        return [
            [1, 'name1', 'text1', 1],
            [2, 'name2', 'text2', 2],
            [3, 'name3', 'text3', 3],
        ];
    }
}

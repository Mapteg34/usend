<?php

namespace Tests\Unit;

use App\Adapters\AdRepositoryInterface;
use App\AdRepositoryFactory;
use PHPUnit\Framework\TestCase;

class AdRepositoryFactoryTest extends TestCase
{
    /**
     * @var AdRepositoryFactory
     */
    private $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new AdRepositoryFactory();
    }

    /**
     * @param $from
     * @param $className
     *
     * @dataProvider providerMain
     *
     * @throws \Exception
     */
    public function testMain($from, $className)
    {
        $res = $this->factory->make($from);
        $this->assertInstanceOf($className, $res);
        $this->assertInstanceOf(AdRepositoryInterface::class, $res);
    }

    public function providerMain()
    {
        $res = [];
        foreach (AdRepositoryFactory::FROM_ENUM as $from => $className) {
            $res[] = [$from, $className];
        }

        return $res;
    }

    /**
     * @throws \Exception
     */
    public function testException()
    {
        $this->expectException('Exception');
        $this->factory->make(rand(1, 100));
    }
}

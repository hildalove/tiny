<?php

use App\Libraby\Caculator;

class CaculatorTest extends PHPUnit_Framework_TestCase
{
    protected $caculator;

    public function setUp()
    {
        $this->caculator = new Caculator();
    }
    public function inputNumbers()
    {
        return [
            [2, 2, 4],
            [2.5, 2.5, 5],
            [-3, 1, -2]
        ];
    }

    /**
     * @dataProvider inputNumbers
     */
    public function testNumbers($x, $y, $sum)
    {
        $this->assertEquals($sum, $this->caculator->add($x, $y));

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfNonNumberIsPasswd()
    {
        $this->caculator->add('a', []);
    }
}

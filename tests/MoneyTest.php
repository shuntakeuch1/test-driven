<?php

use Money\Dollar;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{

    /**
     * 乗算 timesメソッドの比較
     * @test
     */
    public function multiplication()
    {
        $five = new Dollar(5);

        $this->assertTrue((new Dollar(10))->equals($five->times(2)));
        $this->assertTrue(new Dollar(15), $five->times(3));
    }

    /**
     * 同等 三角測量
     * @test
     */
    public function equality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
    }
}
<?php

use Money\Dollar;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{

    /**
     * 乗算
     * @test
     */
    public function Multiplication()
    {
        $five = new Dollar(5);
        $product = $five->times(2);
        $this->assertSame(10, $product->amount);
        $product = $five->times(3);
        $this->assertSame(15, $product->amount);
    }

    /**
     * 同等 三角測量
     * @test
     */
    public function Equality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
    }
}
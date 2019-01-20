<?php

use Money\Money;
use Money\Dollar;
use Money\Franc;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{

    /**
     * 乗算
     * @test
     */
    public function multiplication()
    {
        $five = Money::dollar(5);
        $this->assertTrue(Money::dollar(10)->equals($five->times(2)));
        $this->assertTrue(Money::dollar(15)->equals($five->times(3)));
    }

    /**
     * 同等 三角測量
     * @test
     */
    public function equality()
    {
        $this->assertTrue(Money::dollar(5)->equals(new Dollar(5)));
        $this->assertFalse(Money::dollar(5)->equals(new Dollar(6)));
        $this->assertTrue(Money::franc(5)->equals(new Franc(5)));
        $this->assertFalse(Money::franc(5)->equals(new Franc(6)));
        $this->assertFalse(Money::franc(5)->equals(Money::dollar(5)));
    }

    /**
     * 乗算
     * @test
     */
    public function franMultiplication()
    {
        $five = Money::franc(5);

        $this->assertTrue(Money::franc(10)->equals($five->times(2)));
        $this->assertTrue(Money::franc(15)->equals($five->times(3)));
    }
}

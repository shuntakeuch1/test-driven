<?php

use Money\Money;
use Money\Bank;
use Money\Sum;
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
        $this->assertTrue(Money::dollar(5)->equals(Money::dollar(5)));
        $this->assertFalse(Money::dollar(5)->equals(Money::dollar(6)));
        $this->assertFalse(Money::franc(5)->equals(Money::dollar(5)));
    }

    /**
     * 通貨
     * @test
     */
    public function currency()
    {
        $this->assertSame("USD", Money::dollar(1)->currency());
        $this->assertSame("CHF", Money::franc(1)->currency());
    }

    /**
     * 足し算
     * @test
     */
    public function simpleAddition()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, "USD");
        $this->assertTrue(Money::dollar(10)->equals($reduced));
    }

    /**
     * @test
     */
    public function plusReturnsSum()
    {
        $five = Money::dollar(5);
        $result = $five->plus($five);
        $this->assertTrue($five->equals($result->augend));
        $this->assertTrue($five->equals($result->addend));
    }

    /**
     * @test
     */
    public function reduceSum()
    {
        $sum = new Sum(Money::dollar(3),Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, "USD");
        $this->assertTrue(Money::dollar(7)->equals($result));
    }

    /**
     * @test
     */
    public function reduceMoney()
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::dollar(1), 'USD');
        $this->assertTrue(Money::dollar(1)->equals($result));
    }

    /**
     * @test
     */
    public function reduceMoneyDifferentCurrency()
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce(Money::franc(2), 'USD');
        $this->assertTrue(Money::dollar(1)->equals($result));
    }

    /**
     * @test
     */
    public function identityRate()
    {
        $this->assertSame(1, (new Bank())->rate('USD', 'USD'));
    }

    /**
     * @test
     */
    public function mixedAddition()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);

        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), 'USD');
        $this->assertTrue(Money::dollar(10)->equals($result));
    }

}

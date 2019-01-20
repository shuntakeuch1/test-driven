<?php

namespace Money;

class Money
{
    /** @var int  */
    protected $amount;
    /** @var string */
    protected $currency;

    /**
     * Money constructor.
     * @param int $amount
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param int $multiplier
     * @return Money
     */
    public function times(int $multiplier): Money
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount
            && $this->currency === $money->currency;
    }

    /**
     * @param int $amount
     * @return Money
     */
    public static function dollar(int $amount): Money
    {
        return new Dollar($amount, "USD");
    }

    /**
     * @param int $amount
     * @return Money
     */
    public static function franc(int $amount): Money
    {
        return new Franc($amount, "CHF");
    }
}

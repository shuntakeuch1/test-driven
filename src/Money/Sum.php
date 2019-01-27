<?php

namespace Money;


class Sum implements Expression
{
    /** @var Money */
    public $augend;

    /** @var Money */
    public $addend;

    public function __construct(Money $augend,Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function reduce(string $to): Money
    {
        $amount = $this->augend->amount() + $this->addend->amount();
        return new Money($amount, $to);
    }
}
<?php

namespace Money;

use phpDocumentor\Reflection\Types\Null_;

class Sum implements Expression
{
    /** @var Money */
    public $augend;

    /** @var Money */
    public $addend;

    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->reduce($bank, $to)->amount() + $this->addend->reduce($bank, $to)->amount();
        return new Money($amount, $to);
    }

    public function plus(Expression $addend): Expression
    {
        return null;
    }
}

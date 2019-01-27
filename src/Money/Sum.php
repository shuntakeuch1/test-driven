<?php

namespace Money;

class Sum implements Expression
{
    /** @var Expression */
    public $augend;

    /** @var Expression */
    public $addend;

    public function __construct(Expression $augend, Expression $addend)
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

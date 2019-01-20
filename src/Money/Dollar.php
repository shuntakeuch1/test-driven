<?php

namespace Money;


class Dollar
{
    /** @var int  */
    public $amount;

    /**
     * Dollar constructor.
     * @param int $amount
     */
    function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param int $multiplier
     * @return Dollar
     */
    public function times(int $multiplier): Dollar
    {
        return new Dollar($this->amount * $multiplier);
    }

    /**
     * @param Dollar $dollar
     * @return bool
     */
    public function equals(Dollar $dollar):bool
    {
        return $this->amount === $dollar->amount;
    }
}
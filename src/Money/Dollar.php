<?php

namespace Money;

class Dollar extends Money
{
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
}
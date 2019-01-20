<?php

namespace Money;

class Franc extends Money
{
    /**
     * @param int $multiplier
     * @return Franc
     */
    public function times(int $multiplier): Money
    {
        return Money::franc($this->amount * $multiplier);
    }
}

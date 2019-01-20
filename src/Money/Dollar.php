<?php

namespace Money;

class Dollar extends Money
{
    /**
     * @param int $multiplier
     * @return Dollar
     */
    public function times(int $multiplier): Money
    {
        return Money::dollar($this->amount * $multiplier);
    }
}

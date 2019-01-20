<?php

namespace Money;


class Franc
{
    /** @var int  */
    private $amount;

    /**
     * Franc constructor.
     * @param int $amount
     */
    function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param int $multiplier
     * @return Franc
     */
    public function times(int $multiplier): Franc
    {
        return new Franc($this->amount * $multiplier);
    }

    /**
     * @param Franc $Franc
     * @return bool
     */
    public function equals(Franc $Franc):bool
    {
        return $this->amount === $Franc->amount;
    }
}

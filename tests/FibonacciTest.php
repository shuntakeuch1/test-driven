<?php

use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    public function fib(int $n): int
    {
        if ($n === 0) return 0;
        if ($n === 1) return 1;
        return $this->fib($n - 1) + $this->fib($n - 2);
    }

    public function testFibonacci()
    {
        $cases = [[0,0],[1,1],[2,1],[3,2]];
        for ($i = 0; $i < count($cases); $i++) {
            $result = $this->fib($cases[$i][0]);
            $this->assertSame($cases[$i][1], $result);
        }
    }
}

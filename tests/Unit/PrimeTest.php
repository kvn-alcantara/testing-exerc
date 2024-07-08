<?php

namespace Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Utils\Prime;

class PrimeTest extends TestCase
{
    #[Test]
    public function shouldReturnTrueWhenNumberIsPrime(): void
    {
        $prime = new Prime();
        $result = $prime->isPrime(5);

        $this->assertTrue($result);
    }

    #[Test]
    public function shouldReturnFalseWhenNumberIsNotPrime(): void
    {
        $prime = new Prime();
        $result = $prime->isPrime(4);

        $this->assertFalse($result);
    }
}
<?php

namespace Unit;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Utils\HappyNumbers;

class HappyNumbersTest extends TestCase
{
    #[Test]
    public function shouldReturnTrueWhenNumberIsHappy(): void
    {
        $happyNumbers = new HappyNumbers();

        $this->assertTrue($happyNumbers->isHappy(1));
        $this->assertTrue($happyNumbers->isHappy(7));
    }

    #[Test]
    public function shouldReturnFalseWhenNumberIsNotHappy(): void
    {
        $happyNumbers = new HappyNumbers();

        $this->assertFalse($happyNumbers->isHappy(2));
        $this->assertFalse($happyNumbers->isHappy(3));
    }

    #[Test]
    public function shouldThrowAnExceptionWhenNumberIsLessThanOne(): void
    {
        $happyNumbers = new HappyNumbers();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Number must be greater than 0');

        $happyNumbers->isHappy(0);
    }
}
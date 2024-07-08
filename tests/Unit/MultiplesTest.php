<?php

namespace Unit;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Utils\Multiples;

class MultiplesTest extends TestCase
{
    #[Test]
    public function shouldSumMultiplesWithArrayOfOperators(): void
    {
        $multiples = new Multiples();
        $this->assertEquals(33173, $multiples->sumMultiples(1000, [[3, '||', 5], 7]));
    }

    #[Test]
    public function shouldSumMultiples(): void
    {
        $multiples = new Multiples();
        $this->assertEquals(233168, $multiples->sumMultiples(1000, [[3, '||', 5]]));
        $this->assertEquals(33165, $multiples->sumMultiples(1000, [[3, '&&', 5]]));
    }

    #[Test]
    public function shouldThrowExceptionWhenConditionIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid condition');

        $multiples = new Multiples();
        $multiples->sumMultiples(10, [[3, '||']]);
    }

    #[Test]
    public function shouldThrowExceptionWhenOperatorIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid operator');

        $multiples = new Multiples();
        $multiples->sumMultiples(10, [[3, '>=', 5]]);
    }

    #[Test]
    public function shouldThrowExceptionWhenNumberIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid number');

        $multiples = new Multiples();
        $multiples->sumMultiples(10, [[3, '||', '5']]);
    }

    #[Test]
    public function shouldReturnTrueWhenNumberIsMultipleWithOperator(): void
    {
        $multiples = new Multiples();
        $this->assertTrue($multiples->isMultipleWithOperator(3, [3, '||', 5]));
        $this->assertTrue($multiples->isMultipleWithOperator(5, [3, '||', 5]));
    }

    #[Test]
    public function shouldReturnFalseWhenNumberIsNotMultipleWithOperator(): void
    {
        $multiples = new Multiples();
        $this->assertFalse($multiples->isMultipleWithOperator(4, [3, '||', 5]));
        $this->assertFalse($multiples->isMultipleWithOperator(4, [3, '&&', 5]));
    }
}
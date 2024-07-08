<?php

declare(strict_types=1);

namespace Src\Utils;

use InvalidArgumentException;

class HappyNumbers
{
    public function isHappy(int $number): bool
    {
        if ($number <= 0) {
            throw new InvalidArgumentException('Number must be greater than 0');
        }

        $seen = [];

        while ($number !== 1 && !in_array($number, $seen, true)) {
            $seen[] = $number;
            $number = $this->sumOfSquaresOfDigits($number);
        }

        return $number === 1;
    }

    private function sumOfSquaresOfDigits(int $number): int
    {
        $sum = 0;

        while ($number > 0) {
            $digit = $number % 10;
            $sum += $digit * $digit;
            $number = (int)($number / 10);
        }

        return $sum;
    }
}
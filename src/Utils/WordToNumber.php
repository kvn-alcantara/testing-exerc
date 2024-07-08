<?php

declare(strict_types=1);

namespace Src\Utils;

use InvalidArgumentException;

class WordToNumber
{
    private const ASCII_LOWER_A = 97;
    private const ASCII_LOWER_Z = 122;
    private const ASCII_UPPER_A = 65;

    public function convert(string $word): string
    {
        $parsedToNumber = array_map(fn($c) => ctype_alpha($c) ? $this->charToNumber($c) : $c, str_split($word));

        return implode('', $parsedToNumber);
    }

    private function charToNumber(string $char): int
    {
        $ascii = ord($char);

        if ($ascii >= self::ASCII_LOWER_A && $ascii <= self::ASCII_LOWER_Z) {
            return $ascii + 1 - self::ASCII_LOWER_A;
        }

        return $ascii + 27 - self::ASCII_UPPER_A;
    }
}
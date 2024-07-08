<?php

declare(strict_types=1);

namespace Src\Utils;

use InvalidArgumentException;

class Multiples
{
    public function sumMultiples(int $limit, array $conditions): int
    {
        $sum = 0;

        for ($i = 1; $i < $limit; $i++) {
            $shouldAdd = true;

            foreach ($conditions as $condition) {
                $this->validateConditionFormat($condition);

                if (is_int($condition) && !($i % $condition === 0)) {
                    $shouldAdd = false;
                    break;
                }

                if (is_array($condition) && !$this->isMultipleWithOperator($i, $condition)) {
                    $shouldAdd = false;
                    break;
                }
            }

            if ($shouldAdd) {
                $sum += $i;
            }
        }

        return $sum;
    }

    public function isMultipleWithOperator(int $number, array $condition): bool
    {
        [$first, $operator, $second] = $condition;

        if ($operator === '||') {
            return $number % $first === 0 || $number % $second === 0;
        }

        return $number % $first === 0 && $number % $second === 0;
    }

    private function validateConditionFormat(array|int $condition): void
    {
        if (is_int($condition)) {
            return;
        }

        if (count($condition) !== 3) {
            throw new InvalidArgumentException('Invalid condition');
        }

        if (!in_array($condition[1], ['||', '&&'])) {
            throw new InvalidArgumentException('Invalid operator');
        }

        if (!is_int($condition[0]) || !is_int($condition[2])) {
            throw new InvalidArgumentException('Invalid number');
        }
    }
}
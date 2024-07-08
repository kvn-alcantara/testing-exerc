<?php

namespace Src\Services;

use Src\Utils\HappyNumbers;
use Src\Utils\Multiples;
use Src\Utils\Prime;
use Src\Utils\WordToNumber;

class WordHandler
{
    public function __construct(
        private readonly WordToNumber $wordToNumber,
        private readonly HappyNumbers $happyNumbers,
        private readonly Multiples $multiples,
        private readonly Prime $prime
    ) {
    }

    public function handle(string $word): array
    {
        $word = $this->wordToNumber->convert($word);
        return [
            'toNumber' => $word,
            'isHappy' => $this->happyNumbers->isHappy($word),
            'isMultiple' => $this->multiples->isMultipleWithOperator($word, [3, '||', 5]),
            'isPrime' => $this->prime->isPrime($word)
        ];
    }
}
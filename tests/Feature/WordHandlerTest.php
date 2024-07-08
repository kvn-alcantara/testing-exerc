<?php

namespace Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Services\WordHandler;
use Src\Utils\HappyNumbers;
use Src\Utils\Multiples;
use Src\Utils\Prime;
use Src\Utils\WordToNumber;

class WordHandlerTest extends TestCase
{
    #[Test]
    #[DataProvider('provideWords')]
    public function shouldConvertWordToNumber(string $word, array $expect): void
    {
        $wordHandler = new WordHandler(
            new WordToNumber(),
            new HappyNumbers(),
            new Multiples(),
            new Prime()
        );

        $this->assertEquals($expect, $wordHandler->handle($word));
    }

    public static function provideWords(): array
    {
        return [
            [
                'ba',
                [
                    'toNumber' => 21,
                    'isHappy' => false,
                    'isMultiple' => true,
                    'isPrime' => false
                ]
            ],
            [
                'a',
                [
                    'toNumber' => 1,
                    'isHappy' => true,
                    'isMultiple' => false,
                    'isPrime' => false
                ]
            ],
            [
                'b',
                [
                    'toNumber' => 2,
                    'isHappy' => false,
                    'isMultiple' => false,
                    'isPrime' => true
                ]
            ],
        ];
    }
}
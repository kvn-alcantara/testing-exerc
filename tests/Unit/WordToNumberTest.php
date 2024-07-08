<?php

namespace Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Utils\WordToNumber;

class WordToNumberTest extends TestCase
{
    #[Test]
    public function shouldConvertWordToNumber(): void
    {
        $wordToNumber = new WordToNumber();
        $this->assertEquals('12326', $wordToNumber->convert('abcz'));
    }

    #[Test]
    public function shouldConvertUpperCaseWordToNumber(): void
    {
        $wordToNumber = new WordToNumber();
        $this->assertEquals('27282952', $wordToNumber->convert('ABCZ'));
    }

    #[Test]
    public function shouldIgnoreNonAlphabeticCharacters(): void
    {
        $wordToNumber = new WordToNumber();
        $this->assertEquals('1-2-3-26', $wordToNumber->convert('a-b-c-z'));
    }
}
<?php

declare(strict_types=1);

namespace Src\ValueObjects;

class Cep
{
    public function __construct(private readonly string $cep)
    {
    }

    public function __toString(): string
    {
        return preg_replace('/\D/', '', $this->cep);
    }
}

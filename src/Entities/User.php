<?php

declare(strict_types=1);

namespace Src\Entities;

use Src\ValueObjects\Cep;

class User
{
    public function __construct(public readonly string $name, public readonly Cep $cep)
    {
    }
}
<?php

declare(strict_types=1);

namespace Src\Entities;

class Product
{
    public function __construct(public readonly string $name, public readonly float $price)
    {
    }
}
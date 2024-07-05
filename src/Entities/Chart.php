<?php

declare(strict_types=1);

namespace Src\Entities;

class Chart
{
    private array $productQuantity = [];

    public function __construct(public readonly User $user, private array $products = [])
    {
    }

    public function addProduct(Product $product): void
    {
        $productExists = array_key_exists($product->name, $this->productQuantity);

        if (!$productExists) {
            $this->products[] = $product;
            $this->productQuantity[$product->name] = 1;
            return;
        }

        $this->productQuantity[$product->name]++;
    }

    public function getProducts(): array
    {
        $productQuantity = $this->productQuantity;
        return array_map(
            static fn($product) => ['product' => $product, 'quantity' => $productQuantity[$product->name]],
            $this->products
        );
    }

    public function removeProduct(Product $product): void
    {
        $productExists = array_key_exists($product->name, $this->productQuantity);

        if (!$productExists) {
            return;
        }

        $this->productQuantity[$product->name]--;

        if ($this->productQuantity[$product->name] === 0) {
            $this->productQuantity = array_filter($this->productQuantity, static fn($p) => $p !== $product->name);
            $this->products = array_filter($this->products, static fn($p) => $p->name !== $product->name);
        }
    }

    public function getTotalPrice(): float
    {
        return array_reduce(
            $this->products,
            fn($total, $product) => $total + $product->price * $this->productQuantity[$product->name],
            0
        );
    }
}
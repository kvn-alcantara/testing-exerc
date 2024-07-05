<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Src\Entities\Chart;
use Src\Entities\Product;
use Src\Entities\User;
use Src\ValueObjects\Cep;

class ChartTest extends TestCase
{
    #[Test]
    public function shouldAddProduct(): void
    {
        $product = new Product('Product 1', 10.0);
        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $chart->addProduct($product);

        $products = $chart->getProducts();

        $this->assertCount(1, $products);
        $this->assertEquals(1, $products[0]['quantity']);
    }

    #[Test]
    public function shouldIncrementProductQuantity(): void
    {
        $product = new Product('Product 1', 10.0);
        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $chart->addProduct($product);
        $chart->addProduct($product);

        $products = $chart->getProducts();

        $this->assertCount(1, $products);
        $this->assertEquals(2, $products[0]['quantity']);
    }

    #[Test]
    public function shouldRemoveProduct(): void
    {
        $product = new Product('Product 1', 10.0);
        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $chart->addProduct($product);
        $chart->removeProduct($product);

        $products = $chart->getProducts();

        $this->assertCount(0, $products);
    }

    #[Test]
    public function shouldDecrementProductQuantity(): void
    {
        $product = new Product('Product 1', 10.0);
        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $chart->addProduct($product);
        $chart->addProduct($product);
        $chart->removeProduct($product);

        $products = $chart->getProducts();

        $this->assertCount(1, $products);
        $this->assertEquals(1, $products[0]['quantity']);
    }

    #[Test]
    public function shouldCalculateTotalPrice(): void
    {
        $product1 = new Product('Product 1', 10.0);
        $product2 = new Product('Product 2', 20.0);
        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $chart->addProduct($product1);
        $chart->addProduct($product2);

        $total = $chart->getTotalPrice();

        $this->assertEquals(30.0, $total);
    }
}
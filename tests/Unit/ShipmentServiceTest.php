<?php

namespace Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Src\Contracts\ShipmentGatewayContract;
use Src\Entities\Chart;
use Src\Entities\Product;
use Src\Entities\User;
use Src\Services\ShipmentService;
use Src\ValueObjects\Cep;

class ShipmentServiceTest extends TestCase
{
    #[Test]
    #[DataProvider('taxProvider')]
    public function shouldAddTaxValueOnlyIfTotalPriceIsLessThan100(
        float $productPrice, float $expected
    ): void
    {
        $shipmentGateway = $this->createMock(ShipmentGatewayContract::class);
        $shipmentGateway->method('getTax')->willReturn(10.0);

        $shipmentService = new ShipmentService($shipmentGateway);

        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));
        $chart->addProduct(new Product('Product 1', $productPrice));

        $totalPrice = $shipmentService->getFinalValue($chart);

        $this->assertEquals($expected, $totalPrice);
    }

    public static function taxProvider(): array
    {
        return [
            [99.0, 109.0],
            [100.0, 100.0],
            [101.0, 101.0],
        ];
    }

    #[Test]
    public function callShipmentGatewayOnlyOnce(): void
    {
        $shipmentGateway = $this->createMock(ShipmentGatewayContract::class);
        $shipmentGateway->expects($this->once())->method('getTax')->willReturn(10.0);

        $shipmentService = new ShipmentService($shipmentGateway);

        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));
        $chart->addProduct(new Product('Product 1', 99.0));

        $shipmentService->getFinalValue($chart);
    }

    #[Test]
    public function shouldReturnZeroIfChartIsEmpty(): void
    {
        $shipmentGateway = $this->createMock(ShipmentGatewayContract::class);
        $shipmentGateway->expects($this->never())->method('getTax');

        $shipmentService = new ShipmentService($shipmentGateway);

        $chart = new Chart(user: new User('User 1', new Cep('00000-000')));

        $totalPrice = $shipmentService->getFinalValue($chart);

        $this->assertEquals(0.0, $totalPrice);
    }
}
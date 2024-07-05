<?php

declare(strict_types=1);

namespace Src\Services;

use Src\Contracts\ShipmentGatewayContract;
use Src\Entities\Chart;

class ShipmentService
{
    public function __construct(private readonly ShipmentGatewayContract $shipmentGateway)
    {
    }

    public function getFinalValue(Chart $chart): float
    {
        $totalPrice = $chart->getTotalPrice();

        if ($totalPrice >= 100) {
            return $totalPrice;
        }

        $shipmentTax = $this->shipmentGateway->getTax($chart->user->cep);

        return $totalPrice + $shipmentTax;
    }
}
<?php

declare(strict_types=1);

namespace Src\Gateways;

use Src\Contracts\ShipmentGatewayContract;
use Src\ValueObjects\Cep;

class CorreiosShipmentGateway implements ShipmentGatewayContract
{
    public function getTax(Cep $cep): float
    {
        return 10.00;
    }
}
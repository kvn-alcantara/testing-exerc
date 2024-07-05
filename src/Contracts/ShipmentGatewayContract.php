<?php

namespace Src\Contracts;

use Src\ValueObjects\Cep;

interface ShipmentGatewayContract
{
    public function getTax(Cep $cep): float;
}

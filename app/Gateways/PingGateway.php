<?php


namespace App\Gateways;

use App\Interfaces\PingInterface;

class PingGateway extends BaseGateway
{
    public function __construct(PingInterface $interface)
    {
        $this->setInterface($interface);
    }
}

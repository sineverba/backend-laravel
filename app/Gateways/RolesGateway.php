<?php


namespace App\Gateways;

use App\Interfaces\RolesInterface;

class RolesGateway extends BaseGateway
{
    public function __construct(RolesInterface $interface)
    {
        $this->setInterface($interface);
    }
}

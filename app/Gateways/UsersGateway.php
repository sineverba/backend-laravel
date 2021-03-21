<?php


namespace App\Gateways;

use App\Interfaces\UsersInterface;

class UsersGateway extends BaseGateway
{
    public function __construct(UsersInterface $interface)
    {
        $this->setInterface($interface);
        ;
    }
}

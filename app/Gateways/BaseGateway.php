<?php


namespace App\Gateways;


use Illuminate\Database\Eloquent\Collection;

class BaseGateway
{
    private $interface;

    private function getInterface()
    {
        return $this->interface;
    }

    protected function setInterface($interface)
    {
        $this->interface = $interface;
    }

    public function index():Collection|array
    {
        return $this->getInterface()->index();
    }
}

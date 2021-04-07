<?php


namespace App\Gateways;

class BaseGateway
{
    private $interface;

    protected function getInterface()
    {
        return $this->interface;
    }

    protected function setInterface($interface)
    {
        $this->interface = $interface;
    }

    public function index()
    {
        return $this->getInterface()->index();
    }

    public function show(int $id)
    {
        return $this->getInterface()->show($id);
    }
}

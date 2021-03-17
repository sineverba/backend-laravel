<?php


namespace App\Http\Controllers;

class ApiController extends Controller
{
    private $gateway;

    protected function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    private function getGateway()
    {
        return $this->gateway;
    }

    protected function index()
    {
        return $this->getGateway()->index();
    }
}

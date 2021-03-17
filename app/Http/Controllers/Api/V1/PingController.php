<?php


namespace App\Http\Controllers\Api\V1;

use App\Gateways\PingGateway;
use App\Http\Controllers\ApiController;


class PingController extends ApiController
{
    public function __construct(PingGateway $gateway)
    {
        $this->setGateway($gateway);
    }
}

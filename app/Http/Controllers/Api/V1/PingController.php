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

    /**
     * @OA\Get(
     *   path="/api/v1/ping",
     *   summary="Return current status of app",
     *   tags={"Ping"},
     *    @OA\Response(
     *      response=200,
     *      description="Current app status",
     *      @OA\JsonContent(ref="#/components/schemas/PingSchema")
     *    )
     * )
     */
    public function index()
    {
        $this->index();
    }
}

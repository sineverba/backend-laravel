<?php


namespace App\Http\Controllers\Api\V1;

use App\Gateways\StatsGateway;
use App\Http\Controllers\ApiController;

class StatsController extends ApiController
{
    /**
     * @OA\Get(
     *   path="/api/v1/stats",
     *   summary="Return statistics",
     *   security={{"bearerAuth":{}}},
     *   tags={"Stats"},
     *    @OA\Response(
     *      response=200,
     *      description="Stats",
     *      @OA\JsonContent(ref="#/components/schemas/StatsSchema")
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *    )
     * )
     */
    public function __construct(StatsGateway $gateway)
    {
        parent::__construct();
        $this->setGateway($gateway);
    }
}

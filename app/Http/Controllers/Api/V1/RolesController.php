<?php


namespace App\Http\Controllers\Api\V1;

use App\Gateways\RolesGateway;
use App\Http\Controllers\ApiController;

class RolesController extends ApiController
{
    public function __construct(RolesGateway $gateway)
    {
        $this->setGateway($gateway);
    }

    /**
     * @OA\Get(
     *   path="/api/v1/roles",
     *   summary="Return roles list",
     *   tags={"Roles"},
     *   @OA\Parameter(ref="#/components/parameters/limit_query"),
     *   @OA\Parameter(ref="#/components/parameters/sort_query"),
     *    @OA\Response(
     *      response=200,
     *      description="Role list",
     *      @OA\JsonContent(ref="#/components/schemas/RolesSchema")
     *    )
     * )
     */
}

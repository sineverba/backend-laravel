<?php


namespace App\Http\Controllers\Api\V1;

use App\Gateways\UsersGateway;
use App\Http\Controllers\ApiController;

class UsersController extends ApiController
{
    public function __construct(UsersGateway $gateway)
    {
        parent::__construct();
        $this->setGateway($gateway);
    }

    /**
     * @OA\Get(
     *   path="/api/v1/users",
     *   summary="Return users list",
     *   security={{"bearerAuth":{}}},
     *   tags={"Users"},
     *   @OA\Parameter(ref="#/components/parameters/limit_query"),
     *   @OA\Parameter(ref="#/components/parameters/sort_query"),
     *    @OA\Response(
     *      response=200,
     *      description="Users list",
     *      @OA\JsonContent(ref="#/components/schemas/UsersSchema")
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *    )
     * )
     */
}

<?php


namespace App\Http\Controllers\Api\V1;

use App\Gateways\RolesGateway;
use App\Http\Controllers\ApiController;

class RolesController extends ApiController
{
    public function __construct(RolesGateway $gateway)
    {
        parent::__construct();
        $this->setGateway($gateway);
    }

    /**
     * @OA\Get(
     *   path="/api/v1/roles",
     *   summary="Return roles list",
     *   security={{"bearerAuth":{}}},
     *   tags={"Roles"},
     *   @OA\Parameter(ref="#/components/parameters/limit_query"),
     *   @OA\Parameter(ref="#/components/parameters/page_query"),
     *   @OA\Parameter(ref="#/components/parameters/sort_query"),
     *   @OA\Parameter(ref="#/components/parameters/direction_sort"),
     *    @OA\Response(
     *      response=200,
     *      description="Role list",
     *      @OA\JsonContent(ref="#/components/schemas/RolesSchema")
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *    )
     * )
     *  @OA\Get(
     *   path="/api/v1/roles/{id}",
     *   summary="Return single role",
     *   security={{"bearerAuth":{}}},
     *   tags={"Roles"},
     *    @OA\Response(
     *      response=200,
     *      description="Single Role",
     *      @OA\JsonContent(ref="#/components/schemas/RolesShowSchema")
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *    )
     * )
     *
     * @OA\Post(
     *   path="/api/v1/roles",
     *   summary="Create new role",
     *   security={{"bearerAuth":{}}},
     *   tags={"Roles"},
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"role"},
     *          @OA\Property(
     *              property="role",
     *              description="The name of the new role",
     *              type="string",
     *              example="user",
     *          )
     *       ),
     *   ),
     *    @OA\Response(
     *      response=201,
     *      description="Success message",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="succcess",
     *              description="Success message",
     *              type="string",
     *              example="created"
     *          ),
     *      )
     *    ),
     *    @OA\Response(
     *      response=400,
     *      description="Error on body",
     *    )
     * )
     */
}

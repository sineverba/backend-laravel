<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 * @OA\Parameter(
 *   parameter="page_query",
 *   name="page",
 *   description="Page number of results",
 *   in="query",
 *   @OA\Schema(
 *     type="number", default=1
 *   )
 * ),
 * @OA\Parameter(
 *   parameter="limit_query",
 *   name="per_page",
 *   description="Limit the number of results",
 *   in="query",
 *   @OA\Schema(
 *     type="number", default=15
 *   )
 * ),
 * @OA\Parameter(
 *   parameter="sort_query",
 *   name="sort",
 *   description="Sort the result",
 *   in="query",
 *   @OA\Schema(
 *     type="string", default="id"
 *   )
 * ),
 * @OA\Parameter(
 *   parameter="direction_sort",
 *   name="direction",
 *   description="Direction of sort",
 *   in="query",
 *   @OA\Schema(
 *     type="string", default="asc"
 *   )
 * ),
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

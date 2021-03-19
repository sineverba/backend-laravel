<?php


namespace App\Repositories;

use App\Interfaces\RolesInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="RolesSchema",
 *   title="Roles",
 *   description="Roles model",
 *   @OA\Property(
 *          property="data",
 *          description="List of roles",
 *          type="array",
 *          @OA\Items(
 *               @OA\Property(
 *                  property="id", description="ID of the role", type="number", example=1
 *               ),
 *               @OA\Property(
 *                  property="role", description="Name of the role", type="string", example="admin"
 *               ),
 *          ),
 *   ),
 * )
 */

class RolesRepository extends BaseRepository implements RolesInterface
{
    use SoftDeletes;
    /**
     * The name of the table
     *
     * @var string
     */
    protected $table = "roles";
}

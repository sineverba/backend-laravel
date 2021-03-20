<?php


namespace App\Repositories;

use App\Interfaces\UsersInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *   schema="UsersSchema",
 *   title="Users",
 *   description="Users model",
 *   @OA\Property(
 *          property="data",
 *          description="List of users",
 *          type="array",
 *          @OA\Items(
 *               @OA\Property(
 *                  property="id", description="ID of the user", type="number", example=1
 *               ),
 *               @OA\Property(
 *                  property="email", description="Email", type="string", example="info@example.com"
 *               ),
 *              @OA\Property(
 *                  property="roles",
 *                  description="Associated roles",
 *                  type="array",
 *                   @OA\Items(
         *               @OA\Property(
         *                  property="id", description="ID of the role", type="number", example=1
         *               ),
         *               @OA\Property(
         *                  property="role", description="Role name", type="string", example="admin"
         *               ),
 *          ),
 *              )
 *          ),
 *   ),
 * )
 */

class UsersRepository extends BaseRepository implements UsersInterface
{
    use SoftDeletes;
    /**
     * The name of the table
     *
     * @var string
     */
    protected $table = "users";

    /**
     * Return associated role
     */
    public function roles()
    {
        return $this->hasOne(RolesRepository::class, 'id', 'role_id');
    }

    /**
     * Return data
     */
    public function index()
    {
        return $this
                ->with('roles')
                ->sort(request())
                ->paginate($this->getPerPage());
    }
}

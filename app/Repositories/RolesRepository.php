<?php


namespace App\Repositories;

use App\Interfaces\RolesInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 *               @OA\Property(
 *                  property="users",
 *                  description="List of associated Users",
 *                  type="array",
 *                   @OA\Items(
 *                      @OA\Property(
 *                          property="id", description="ID of the user", type="number", example=1
 *                      ),
 *                      @OA\Property(
 *                          property="email", description="Email", type="string", example="info@example.com"
 *                      ),
 *                  ),
 *              )
 *          ),
 *   ),
 * )
 *
 *  @OA\Schema(
 *   schema="RolesPostSchema",
 *   title="Roles",
 *   description="Roles model",
 *   @OA\Property(
 *          property="data",
 *          description="New Role",
 *          type="object",
 *          @OA\Items(
 *               @OA\Property(
 *                  property="role", description="Name of the role", type="string", example="admin"
 *               )
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

    /**
     * The sortable columns
     */
    public $sortables = [
        'id',
        'role',
        'created_at',
        'updated_at'
    ];

    /**
     * The attribute mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'role',
    ];

    /**
     * Return associated users
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(
            'App\Repositories\UsersRepository',
            'role_id',
            'id'
        );
    }

    public function index()
    {
        return $this
            ->with('users')
            ->sort(request())
            ->paginate($this->getPerPage());
    }
}

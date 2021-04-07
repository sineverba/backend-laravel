<?php


namespace App\Gateways;

use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;

/**
 * @OA\Schema(
 *   schema="StatsSchema",
 *   title="Stats",
 *   description="Statistics model",
 *   @OA\Property(
 *      property="users", description="Number of the user in the database", type="number", example=3
 *   ),
 *   @OA\Property(
 *      property="roles", description="Number of the roles in the database", type="number", example=2
 *   ),
 * )
 */
class StatsGateway extends BaseGateway
{
    public function index()
    {
        $user_repository = new UsersRepository();
        $roles_repository = new RolesRepository();
        $users = $user_repository->count();
        $roles = $roles_repository->count();

        return [
            'users' => $users,
            'roles' => $roles,
        ];
    }
}

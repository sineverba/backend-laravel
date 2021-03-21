<?php


namespace Database\Factories\Repositories;


use App\Repositories\UsersRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersRepositoryFactory extends Factory
{

    protected $model = UsersRepository::class;

    public function definition()
    {
        return [
            'email' => 'info@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => 1,
        ];
    }
}

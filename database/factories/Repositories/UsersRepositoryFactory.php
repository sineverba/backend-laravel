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
            'role_id' => 1,
        ];
    }
}

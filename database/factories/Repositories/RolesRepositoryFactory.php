<?php


namespace Database\Factories\Repositories;


use App\Repositories\RolesRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class RolesRepositoryFactory extends Factory
{

    protected $model = RolesRepository::class;

    public function definition()
    {
        return [
            'role' => 'admin',
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin role with id 1
        RolesRepository::factory()->create();
        // Admin user
        UsersRepository::factory()->create();
    }
}

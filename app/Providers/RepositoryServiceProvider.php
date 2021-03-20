<?php


namespace App\Providers;

use App\Interfaces\PingInterface;
use App\Interfaces\RolesInterface;
use App\Interfaces\UsersInterface;
use App\Repositories\PingRepository;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PingInterface::class,
            PingRepository::class
        );

        $this->app->bind(
            RolesInterface::class,
            RolesRepository::class
        );

        $this->app->bind(
            UsersInterface::class,
            UsersRepository::class
        );
    }
}

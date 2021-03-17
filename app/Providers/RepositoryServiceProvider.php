<?php


namespace App\Providers;


use App\Interfaces\PingInterface;
use App\Repositories\PingRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PingInterface::class,
            PingRepository::class
        );
    }
}

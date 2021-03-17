<?php


namespace App\Repositories;

use App\Interfaces\PingInterface;

class PingRepository implements PingInterface
{
    public function index():array
    {
        $data = array();

        $data['app_version'] = env('APP_VERSION', '0.0.1');

        return $data;
    }
}

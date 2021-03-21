<?php


namespace Tests\Unit\Middlewares;


use App\Http\Middleware\TrustHosts;
use Tests\TestCase;

class TrustHostsTest extends TestCase
{
    public function test_hosts()
    {
        $middleware = new TrustHosts($this->app);
        $this->assertIsArray($middleware->hosts());
    }
}

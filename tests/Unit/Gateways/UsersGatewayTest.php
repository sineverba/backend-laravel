<?php


namespace Tests\Unit\Gateways;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersGatewayTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private $gateway = 'App\Gateways\UsersGateway';

    /**
     * Test can instantiate class
     *
     * @return void
     */
    public function test_can_instantiate_class(): void
    {
        $this->withoutExceptionHandling();
        $gateway = $this->app->make($this->gateway);
        $this->assertInstanceOf($this->gateway, $gateway);
    }

    /**
     * Test can index
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_can_index():void
    {
        $this->withoutExceptionHandling();
        $gateway = $this->app->make($this->gateway);
        $records = $gateway->index();
        $this->assertTrue(count($records) === 0);
        $this->seed(DatabaseSeeder::class);
        $records = $gateway->index();
        $this->assertTrue(count($records) === 1);
    }
}

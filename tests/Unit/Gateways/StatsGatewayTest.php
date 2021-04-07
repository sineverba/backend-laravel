<?php


namespace Tests\Unit\Gateways;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatsGatewayTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * The gateway
     *
     * @var string
     */
    private $gateway = 'App\Gateways\StatsGateway';

    /**
     * Test can instantiate class
     */
    public function test_can_instantiate_class():void
    {
        $this->withoutExceptionHandling();
        $gateway = $this->app->make($this->gateway);
        $this->assertInstanceOf($this->gateway, $gateway);
    }

    /**
     * Test returns array
     */
    public function test_index():void
    {
        $this->withoutExceptionHandling();
        $payload = [
            'users' => 0,
            'roles' => 0,
        ];
        $gateway = $this->app->make($this->gateway);
        $this->assertEquals($payload, $gateway->index());

        $this->seed(DatabaseSeeder::class);
        $payload = [
            'users' => 1,
            'roles' => 1,
        ];
        $this->assertEquals($payload, $gateway->index());
    }
}

<?php


namespace Tests\Unit\Gateways;


use App\Repositories\RolesRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesGatewayTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    /**
     * The gateway
     *
     * @var string
     */
    private $gateway = 'App\Gateways\RolesGateway';

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
        RolesRepository::factory()->create();
        $records = $gateway->index();
        $this->assertTrue(count($records) === 1);
    }
}

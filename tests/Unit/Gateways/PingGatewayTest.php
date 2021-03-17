<?php


namespace Tests\Unit\Gateways;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class PingGatewayTest extends TestCase
{
    /**
     * The gateway
     *
     * @var string
     */
    private $gateway = 'App\Gateways\PingGateway';

    /**
     * Test can instantiate the class
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_can_instantiate_class(): void
    {
        $this->withoutExceptionHandling();
        $gateway = $this->app->make($this->gateway);
        $this->assertInstanceOf($this->gateway, $gateway);
    }

    /**
     * Test index ping repository returns array
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_index():void
    {
        $this->withoutExceptionHandling();
        $payload = [
            'app_version' => '0.0.1'
        ];
        $gateway = $this->app->make($this->gateway);
        $this->assertEquals($payload, $gateway->index());
    }
}

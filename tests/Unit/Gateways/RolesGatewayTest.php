<?php


namespace Tests\Unit\Gateways;


use Database\Seeders\DatabaseSeeder;
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
        $this->seed(DatabaseSeeder::class);
        $records = $gateway->index();
        $this->assertTrue(count($records) === 1);
    }

    /**
     * Test cannot store if validator fails
     *
     * @return void
     */
    public function test_cannot_store_if_validator_fails()
    {
        $gateway = $this->app->make($this->gateway);
        $this->seed(DatabaseSeeder::class);
        $payload = [
            'role' => 'admin'
        ];
        // 1 - Test unique
        $errors = $gateway->store($payload);
        $errors = $errors->getMessages();
        $this->assertTrue($errors['role'][0] === 'The role has already been taken.');
        // 2 - Test required
        $payload = [];
        $errors = $gateway->store($payload);
        $errors = $errors->getMessages();
        $this->assertTrue($errors['role'][0] === 'The role field is required.');
    }

    /**
     * Test can store
     *
     * @return void
     */
    public function test_can_store()
    {
        $gateway = $this->app->make($this->gateway);
        $payload = [
            'role' => 'admin'
        ];
        $store = $gateway->store($payload);
        $this->assertTrue($store);
    }
}

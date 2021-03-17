<?php


namespace Tests\Unit\Repositories;

use Tests\TestCase;

use App\Repositories\PingRepository;

class PingRepositoryTest extends TestCase
{
    /**
     * Test can instantiate class
     *
     * @return void
     */
    public function test_can_instantiate_class():void
    {
        $this->withoutExceptionHandling();
        $repository = new PingRepository();
        $this->assertInstanceOf('App\Repositories\PingRepository', $repository);
    }

    /**
     * Test index ping repository returns array
     *
     * @return void
     */
    public function test_index():void
    {
        $this->withoutExceptionHandling();
        $payload = [
            'app_version' => '0.0.1'
        ];
        $repository = new PingRepository();
        $this->assertEquals($payload, $repository->index());
    }
}

<?php


namespace Tests\Feature\Routes;

use Tests\TestCase;

class PingTest extends TestCase
{
    /**
     * Test GET /ping
     *
     * @return void
     */
    public function test_get_ping():void
    {
        $this->withoutExceptionHandling();
        $request = $this->json(
            'GET',
            Route('ping_index')
        );
        $request->assertJsonStructure(
            [
                'app_version'
            ]
        );
        $data = $request->getData();
        $this->assertTrue($data->app_version === '0.0.1');
    }
}

<?php


namespace Tests\Feature\Routes;


use App\Repositories\RolesRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * Test GET /roles
     *
     * @return void
     */
    public function test_route_get(): void
    {
        $this->withoutExceptionHandling();
        // 0 items
        $request = $this->json(
            'GET',
            Route('roles_index')
        );
        $request->assertStatus(200);
        $request->assertJsonCount(0, $request->getData());
        // 1 item
        RolesRepository::factory()->create();
        $request = $this->json(
            'GET',
            Route('roles_index')
        );
        $request->assertJsonStructure([]);
        $data = $request->getData();
        $this->assertTrue($data[0]->role === 'admin');
    }
}

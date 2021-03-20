<?php


namespace Tests\Feature\Routes;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * Test GET /users
     *
     * @return void
     */
    public function test_route_get(): void
    {
        $this->withoutExceptionHandling();
        // 0 items
        $request = $this->json(
            'GET',
            Route('users_index'),
            [
                'sort' => 'id',
                'direction' => 'desc'
            ]
        );
        $request->assertStatus(200);
        $request->assertJsonStructure(
            [
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]
        );
        $request->assertJsonFragment([
            'total' => 0,
            'per_page' => 15
        ]);

        // 1 item
        $this->seed(DatabaseSeeder::class);
        $request = $this->json(
            'GET',
            Route('users_index')
        );
        $request->assertJsonStructure([]);
        $data = $request->getData();
        $this->assertEquals(1, $data->data[0]->id);
        $this->assertEquals('info@example.com', $data->data[0]->email);
        $this->assertEquals('admin', $data->data[0]->roles->role);

        $request->assertJsonFragment([
            'total' => 1,
            'per_page' => 15
        ]);
    }
}

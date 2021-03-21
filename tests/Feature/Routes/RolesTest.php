<?php


namespace Tests\Feature\Routes;


use App\Repositories\UsersRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * Test cannot index without token
     *
     * @return void
     */
    public function test_cannot_index_without_token()
    {
        $request = $this->json(
            'GET',
            Route('roles_index')
        );
        $request->assertJsonStructure(
            [
                'error',
            ]
        );
        $request->assertStatus(401);
        $request->assertJsonFragment([
            'error' => 'Unauthenticated',
        ]);
    }

    /**
     * Test GET /roles
     *
     * @return void
     */
    public function test_route_get(): void
    {
        $payload = [
            'email' => 'admin@example.com',
            'role_id' => null,
        ];
        $user = UsersRepository::factory()->create($payload);
        $token = auth()->fromUser($user);
        // 0 items
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
            'GET',
            Route('roles_index'),
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
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
                'GET',
                Route('roles_index'),
                [
                    'sort' => 'id',
                    'direction' => 'desc'
                ]
            );
        $request->assertJsonStructure([]);
        $data = $request->getData();
        $this->assertTrue($data->data[0]->role === 'admin');

        $request->assertJsonFragment([
            'total' => 1,
            'per_page' => 15
        ]);
    }
}

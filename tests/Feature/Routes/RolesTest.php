<?php


namespace Tests\Feature\Routes;


use App\Repositories\RolesRepository;
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

    /**
     * Test cannot store without token
     *
     * @return void
     */
    public function test_cannot_store_without_token()
    {
        $payload = [
            'role' => 'user'
        ];
        $request = $this->json(
            'POST',
            Route('roles_store'),
            $payload,
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
     * Test cannot store if validator fails
     *
     * @return void
     */
    public function test_cannot_store_if_validator_fails()
    {
        $this->withoutExceptionHandling();
        // Create the user
        $payload = [
            'email' => 'admin@example.com',
            'role_id' => null,
        ];
        $user = UsersRepository::factory()->create($payload);
        $token = auth()->fromUser($user);

        // Create first role
        RolesRepository::factory()->create();

        // Create the request and fails with duplicate
        $payload = [
            'role' => 'admin'
        ];
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
            'POST',
            Route('roles_store'),
            $payload,
        );
        $request->assertStatus(400);
        $request->assertJsonFragment(
            [
                'role' => [
                    'The role has already been taken.'
                ],
            ]
        );

        // Create the request and fails with required
        $payload = [];
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
                'POST',
                Route('roles_store'),
                $payload,
            );
        $request->assertStatus(400);
        $request->assertJsonFragment(
            [
                'role' => [
                    'The role field is required.'
                ],
            ]
        );
    }

    /**
     * Test can store
     *
     * @return void
     */
    public function test_can_store()
    {
        $this->withoutExceptionHandling();
        // Create the user
        $payload = [
            'email' => 'admin@example.com',
            'role_id' => null,
        ];
        $user = UsersRepository::factory()->create($payload);
        $token = auth()->fromUser($user);

        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertCount(0, $items);

        $payload = [
            'role' => 'admin'
        ];
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
                'POST',
                Route('roles_store'),
                $payload,
            );
        $request->assertStatus(201);
        $request->assertJsonFragment(
            [
                'success' => 'created',
            ]
        );

        $items = $repository->index();
        $this->assertCount(1, $items);

    }

    /**
     * Test cannot show without token
     *
     * @return void
     */
    public function test_cannot_show_without_token()
    {
        $request = $this->json(
            'GET',
            Route('roles_show',
                [
                    'id' => 1,
                ]
            )
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
     * Test can show
     *
     * @return void
     */
    public function test_can_show()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => 'admin@example.com',
            'role_id' => null,
        ];
        $user = UsersRepository::factory()->create($payload);
        $token = auth()->fromUser($user);
        $this->seed(DatabaseSeeder::class);
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
            'GET',
            Route('roles_show',
                [
                    'id' => 1,
                ]
            )
        );
        $request->assertStatus(200);
        $data = $request->getData();
        $this->assertTrue($data->id === 1);
        $this->assertTrue($data->role === 'admin');
    }
}

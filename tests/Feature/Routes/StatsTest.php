<?php


namespace Tests\Feature\Routes;


use App\Repositories\UsersRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatsTest extends TestCase
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
            Route('stats_index')
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
     * Test can index
     *
     * @return void
     */
    public function test_can_index(): void
    {
        $this->withoutExceptionHandling();
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
                Route('stats_index')
            );
        $request->assertStatus(200);
        $request->assertJsonStructure(
            [
                'users',
                'roles',
            ]
        );
        $request->assertJsonFragment([
            'users' => 1,
            'roles' => 0,
        ]);

        // 1 item
        $this->seed(DatabaseSeeder::class);
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
                'GET',
                Route('stats_index')
            );
        $request->assertJsonStructure(
            [
                'users',
                'roles',
            ]
        );
        $request->assertJsonFragment([
            'users' => 2,
            'roles' => 1,
        ]);
        $data = $request->getData();
        $this->assertTrue($data->users == 2);
        $this->assertTrue($data->roles == 1);

    }
}

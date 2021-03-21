<?php


namespace Tests\Feature\Routes;


use App\Repositories\UsersRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * Test cannot login if username or password are wrong
     *
     * @return void
     */
    public function test_cannot_login()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => 'info@example.com',
            'password' => 'wrongpassword'
        ];
        $request = $this->json(
            'POST',
            (Route('login')),
            $payload
        );
        $request->assertStatus(401);
        $request->assertJsonStructure(
            [
                'error'
            ]
        );
        $request->assertJsonFragment([
            'error' => 'Invalid username or password',
        ]);
    }

    /**
     * Test can login
     *
     * @return void
     */
    public function test_can_login()
    {
        $payload = [
            'email' => 'info@example.com',
            'password' => Hash::make('password'),
            'role_id' => null,
        ];
        UsersRepository::factory()->create($payload);
        $request = $this->json(
            'POST',
            (Route('login')),
            [
                'email' => 'info@example.com',
                'password' => 'password'
            ]
        );
        $request->assertStatus(200);
        $request->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }
}

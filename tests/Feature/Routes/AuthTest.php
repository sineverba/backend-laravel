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

    /**
     * Test can refresh token
     *
     * @return void
     */
    public function test_can_refresh_token()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => 'admin@example.com',
            'role_id' => null,
        ];
        $user = UsersRepository::factory()->create($payload);
        $token = auth()->fromUser($user);
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->json(
            'POST',
            (Route('refresh')),
            [
                'token' => $token
            ]
        );
        $request->assertStatus(200);
        $request->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
        $data = $request->getData();
        $new_token = $data->access_token;
        $this->assertNotEquals($new_token, $token);
    }

    /**
     * Test cannot refresh token without valid token
     */
    public function test_cannot_refresh_token()
    {
        //$this->withoutExceptionHandling();
        //$this->expectException(JWTException::class);
        $request = $this
            ->withHeaders([
                'Authorization' => 'Bearer invalid',
            ])

            ->json(
                'POST',
                (Route('refresh')),
                [
                    'token' => 'invalid'
                ]
            );
        $request->assertStatus(401);
        $request->assertJsonStructure(
            [
                'error'
            ]
        );
        $data = $request->getData();
        $this->assertTrue($data->error === "Token could not be parsed from the request.");
    }

    /**
     * Test can login with unused keys
     *
     * @return void
     */
    public function test_can_login_with_unused_keys()
    {
        $this->withoutExceptionHandling();
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
                'password' => 'password',
                'foo' => 'bar'
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

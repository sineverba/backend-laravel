<?php


namespace Tests\Unit\Repositories;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Repositories\RolesRepository;

class RolesRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * Test can instantiate class
     *
     * @return void
     */
    public function test_can_instantiate_class():void
    {
        $this->withoutExceptionHandling();
        $repository = new RolesRepository();
        $this->assertInstanceOf('App\Repositories\RolesRepository', $repository);
    }

    /**
     * Test index with no data returns 0 items
     *
     * @return void
     */
    public function test_index_with_no_data_returns_zero():void
    {
        $this->withoutExceptionHandling();
        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $items);
        $this->assertCount(0, $items);
    }

    /**
     * Test index with 1 item return 1 item
     *
     * @return void
     */
    public function test_index_with_one_item_returns_one_item(): void
    {
        $this->withoutExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertCount(1, $items);
        $this->assertEquals('admin', $items[0]->role);
    }

    /**
     * Test index returns associated users
     *
     * @return void
     */
    public function test_index_return_associated_users(): void
    {
        $this->withoutExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertEquals(1, $items[0]->users[0]->id);
        $this->assertEquals('info@example.com', $items[0]->users[0]->email);

    }

    /**
     * Test can store new role
     *
     * @return void
     */
    public function test_can_store(): void
    {
        $this->withoutExceptionHandling();
        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertCount(0, $items);
        $payload = [
            'role' => 'admin'
        ];
        $repository->store($payload);
        $items = $repository->index();
        $this->assertCount(1, $items);

    }
}

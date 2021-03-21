<?php


namespace Tests\Unit\Repositories;


use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\UsersRepository;

class UsersRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * Test can instantiate class
     *
     * @return void
     */
    public function test_can_instatiate_class(): void
    {
        $this->withoutExceptionHandling();
        $repository = new UsersRepository();
        $this->assertInstanceOf('App\Repositories\UsersRepository', $repository);
    }

    /**
     * Test index with no data returns 0 items
     *
     * @return void
     */
    public function test_index_with_no_data_returns_zero():void
    {
        $this->withoutExceptionHandling();
        $repository = new UsersRepository();
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
        $repository = new UsersRepository();
        $items = $repository->index();
        $this->assertCount(1, $items);
        $this->assertEquals(1, $items[0]->id);
        $this->assertEquals('info@example.com', $items[0]->email);

    }

    /**
     * Test index returns associated role
     *
     * @return void
     */
    public function test_index_return_associated_role(): void
    {
        $this->withoutExceptionHandling();
        $this->seed(DatabaseSeeder::class);
        $repository = new UsersRepository();
        $items = $repository->index();
        $this->assertEquals('admin', $items[0]->roles->role);
    }
}

<?php


namespace Tests\Unit\Repositories;
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
        RolesRepository::factory()->create();
        $repository = new RolesRepository();
        $items = $repository->index();
        $this->assertCount(1, $items);
        $this->assertEquals($items[0]->role, 'admin');
    }
}

<?php


namespace Tests\Feature\Exceptions;


use Tests\TestCase;

class HttpNotFoundExceptionTest extends TestCase
{
    /**
     * Test inexisting route returns 404
     *
     */
    public function test_not_found_exception()
    {
        $request = $this
            ->json(
                'GET',
                '/api/v0/not-found'
            );
        $request->assertStatus(404);
        $request->assertJsonFragment([
            'error' => 'Not found'
        ]);
    }
}

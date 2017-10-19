<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_browse_threads()
    {
        factory('App\Thread', 5)->create();

        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}

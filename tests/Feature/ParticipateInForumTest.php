<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function unauthenicated_users_may_not_add_replies()
    {
        $this->post("{$this->thread->path()}/replies", [])
            ->assertRedirect('/login');
    }
    /** @test */
    public function an_authenicated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $reply = make('App\Reply');

        $this->post($this->thread->path() . '/replies', $reply->toArray());
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenicated_users_may_not_add_replies()
    {
        $this->withoutExceptionHandling();
        
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $reply = make('App\Reply');
        $this->post('/threads/1/replies', $reply->toArray());
    }
    /** @test */
    public function an_authenicated_user_may_participate_in_forum_threads()
    {
        $user = create('App\User');

        $this->be($user);

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        $this->get('/threads/' . $thread->id)
            ->assertSee($reply->body);
    }
}

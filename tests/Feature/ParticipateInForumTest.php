<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_an_unauthenticated_user_may_not_add_replies()
    {
        $this->get('threads/1/replies')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_an_authenticated_user_may_participate_in_forum_thread()
    {
        $this->be($user = User::factory()->create());

        $thread = create(Thread::class);
        $reply  = create(Reply::class, [
            'thread_id' => $thread->id,
            'user_id'   => $user->id,
        ]);
        
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}

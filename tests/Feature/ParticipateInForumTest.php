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
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
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

    /**
     * @test
     */
    public function test_a_reply_requires_a_body()
    {
        $this->withExceptionHandling()
            ->signIn();

        $thread = create(Thread::class);
        $reply  = make(Reply::class, ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();

        $reply = create(Reply::class);

        $this->delete('/replies/'. $reply->id)
            ->assertRedirect('/login');

        $this->signIn()
            ->delete('/replies/'. $reply->id)
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->delete('/replies/'. $reply->id)->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}

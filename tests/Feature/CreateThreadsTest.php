<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_a_guest_may_not_create_new_forum_threads()
    {
        $this->withoutExceptionHandling(); // Disable exception handling for better debugging (optional)

        $this->expectException(AuthenticationException::class);

        $thread = make(Thread::class);
        $this->post('/threads', $thread->toArray());
    }

    /**
     * @test
     */
    public function test_guests_cannot_see_the_thread_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_an_authenticated_user_can_create_new_form_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * @test
     */
    public function test_guests_cannot_delete_threads()
    {
        $this->withExceptionHandling();
        
        $thread = create(Thread::class);
        
        $response = $this->delete($thread->path());
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_a_thread_can_be_deleted()
    {
        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $reply  = create(Reply::class, ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /**
     * @helper function
     */
    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()
            ->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /**
     * @test
     */
    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */
    public function test_a_thread_requires_a_valid_channel()
    {
        Channel::factory(2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }
}

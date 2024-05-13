<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
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
    public function test_an_authenticated_user_can_create_new_form_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);
        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}

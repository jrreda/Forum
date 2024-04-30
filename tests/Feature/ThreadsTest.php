<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /**
     * @test
     */
    public function test_a_user_can_browse_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function test_a_user_can_read_a_single_thread()
    {       
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function test_a_user_can_read_thread_replies()
    {       
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}

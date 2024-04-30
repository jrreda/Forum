<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_a_user_can_browse_all_threads()
    {
        $thread = Thread::factory()->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    /**
     * @test
     */
    public function test_a_user_can_read_a_single_thread()
    {
        $thread = Thread::factory()->create();
        
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}

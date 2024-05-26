<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ChannelTest extends TestCase
{    
    protected $thread;

    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_a_channel_has_threads()
    {
        $channel = create(Channel::class);
        $thread  = create(Thread::class, [
            'channel_id' => $channel->id,
        ]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}

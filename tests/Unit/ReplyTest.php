<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_reply_has_an_owner()
    {
        // Create a user (owner)
        $user = User::factory()->create();

        // Create a post reply and associate it with the user
        $reply = Reply::factory()->create(['user_id' => 1]);

        // Assert that the reply has an owner
        $this->assertInstanceOf(User::class, $reply->owner);
    }
}

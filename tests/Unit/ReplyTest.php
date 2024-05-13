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

    /**
     * Test to check if a post reply has an owner.
     *
     * @return void
     */
    public function test_reply_has_an_owner()
    {
        // Create a user (owner)
        $user = create(User::class);

        // Create a post reply and associate it with the user
        $reply = create(Reply::class, ['user_id' => 1]);

        // Assert that the reply has an owner
        $this->assertInstanceOf(User::class, $reply->owner);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_a_guest_may_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Throwable $th) {
            $this->fail('Didn\'t expect to insert the same reply twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}

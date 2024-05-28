<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::factory()->admin()->create();

        // Create other users
        User::factory(10)->create();

        // Seed threads
        $threads = Reply::factory(50)->create();

        // For each thread, create 10 replies
        $threads->each(function ($thread) { 
            Reply::factory(10)->create(['thread_id' => $thread->id]); 
        });
    }
}

<?php

namespace Database\Seeders;
use App\Models\Podcast;
use App\Models\Episode;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory(5)->create()->each( function($user)
        {
            Podcast::factory(3)->create(['user_id' => $user->id])->each(function($podcast)
            {
                Episode::factory(2)->create(['podcast_id' => $podcast->id]);
            });
        });

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
